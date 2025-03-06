@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Résultats de recherche pour "{{ $query }}"</h1>

    @if($products->isEmpty())
        <p>Aucun produit trouvé.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-bold">{{ $product->product_name }}</h2>
                    <p>{{ $product->description }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="text-green-500 hover:underline">Voir le produit</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection