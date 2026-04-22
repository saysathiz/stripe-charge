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
                            <span class="plan-price