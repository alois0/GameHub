@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        
        <h1 class="mb-4">Home</h1>

        <div class="row">
            <h2>All Products</h2>
        
            @foreach($products as $product)
                <div class="col-md-4 mb-4"> <!-- Use col-md-4 to make 3 cards per row -->
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->product_name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">£{{ $product->price }}</p>
                            <a href="{{ route('products.show', ['product_id' => $product->product_id]) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
