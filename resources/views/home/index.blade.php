@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero">
    <div class="slider-container">
        @if(!empty($sliders))
            @foreach($sliders as $index => $slider)
                <div class="slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                    <div class="slide-image">
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider image">
                    </div>
                </div>
            @endforeach
        @else
            <div class="slide active">
                <div class="slide-image">
                    <img src="{{ asset('images/default-slider.jpg') }}" alt="Welcome to BeautyLatory">
                </div>
            </div>
        @endif

        <div class="slider-nav">
            @for($i = 0; $i < count($sliders); $i++)
                <span class="slider-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></span>
            @endfor
        </div>
    </div>
</section>

<section class="featured-products">
    <div class="container">
        <h2>Featured Products</h2>
        <div class="products-grid">
            @if(!empty($products))
                @foreach(array_slice($products->toArray(), 0, 8) as $product)
                    <div class="product-card">
                        @if(!empty($product['image']))
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}">
                            </div>
                        @endif
                        <div class="product-info">
                            <h3>{{ $product['name'] }}</h3>
                            <p class="product-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $product['id']) }}" class="btn btn-secondary">View Details</a>
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