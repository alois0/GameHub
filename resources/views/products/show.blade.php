@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <style>
            .product-details {
                color: white; /* Make text white */
            }
            .product-details .btn {
                color: black; /* Make button text black */
            }
            
        </style>

        <h1 class="mb-4 product-details">{{ $product->product_name }}</h1>
        <div class="row gy-5">
            <div class="col-md-6">
                <img src="{{ asset('images/' . $product->image_path) }}" class="img-fluid" alt="{{ $product->product_name }}">
            </div>
            <div class="col-md-6 product-details">
                <h2>£{{ $product->price }}</h2>
                <p>{{ $product->description }}</p>
                <p><strong>Category:</strong> {{ $product->category ? $product->category->category_name : 'N/A' }}</p>
                <p><strong>Platform:</strong> {{ $product->platform ? $product->platform->platform_name : 'N/A' }}</p>
                <a href="#" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>
    </div>
@endsection