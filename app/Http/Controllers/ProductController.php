<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Auth,Session;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the product details and pass them to the view
        $products = Products::all();

        return view('home', compact('products'));
    }

    public function charge(Request $request, $product_id)
    {
        $product = Products::find($product_id);
        $user = Auth::user();
        return view('payment',[
            'user'=>$user,
            'intent' => $user->createSetupIntent(),
            'product' => $product->name,
            'price' => $product->price
        ]);
    }

    public function processPayment(Request $request, String $product, $price)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        try
        {
            $user->charge($price*100, $paymentMethod);
        }
        catch (\Exception $e)
        {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        Session::flash('message', 'Payment was done.'); 
        return redirect('home');
    }
}
