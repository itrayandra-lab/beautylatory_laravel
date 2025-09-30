@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="products-page">
        <div class="container">
            <h1>Our Products</h1>

            <!-- Category Filter -->
            <div class="category-filter">
                <h3>Filter by Category</h3>
                <div class="category-list">
                    <a href="{{ route('products.index') }}"
                        class="category-link {{ !request()->has('category') || empty(request()->get('category')) ? 'active' : '' }}">All
                        Products</a>
                    @forelse($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}"
                            class="category-link {{ request()->get('category') == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                @if (!empty($products))
                    @foreach ($products as $product)
                        <div class="product-card">
                            @if (!empty($product->image))
                                <div class="product-image">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    </a>
                                </div>
                            @endif
                            <div class="product-info">
                                <h3>{{ $product->name }}</h3>
                                <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">View
                                    Details</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No products available at the moment.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
