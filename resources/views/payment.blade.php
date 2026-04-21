@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>
                <div class="card-body">
                    <form action="{{ route('processPayment', $product) }}" method="POST" id="subscribe-form">
                        @csrf
                        <div class="form-group mb-3">
                            <span class="plan-price">${{ $product->price }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="card-holder-name">Card Holder Name</label>
                            <input id="card-holder-name" type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="card-element">Credit or debit card</label>
                            <div id="card-element" class="form-control"></div>
                            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group text-center">
                            <button type="button"
                                    id="card-button"
                                    data-secret="{{ $intent->client_secret }}"
                                    data-stripe-key="{{ config('cashier.key') }}"
                                    class="btn btn-lg btn-success">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/" defer></script>
    @vite('resources/js/payment.js')
@endpush
@endsection
