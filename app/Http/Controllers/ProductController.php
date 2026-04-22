<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page = (int) $request->input('page', 1);

        $products = Cache::remember("products.page.{$page}", 60, function () {
            return Products::orderBy('id')->paginate(12);
        });

        return view('home', compact('products'));
    }

    public function charge(Products $product)
    {
        $user = Auth::user();

        return view('payment', [
            'user' => $user,
            'intent' => $user->createSetupIntent(),
            'product' => $product,
        ]);
    }

    public function processPayment(Request $request, Products $product)
    {
        $request->validate(['payment_method' => 'required|string']);

        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');

        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);

        try {
            $user->charge((int) round($product->price * 100), $paymentMethod);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error processing payment. ' . $e->getMessage()]);
        }

        Session::flash('message', 'Payment was done.');

        return redirect()->route('home');
    }
}