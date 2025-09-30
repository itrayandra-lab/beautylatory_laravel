@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section class="product-detail">
    <div class="container">
        <div class="product-detail-container">
            <div class="product-image">
                @if(!empty($product->image))
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <div class="no-image">No Image Available</div>
                @endif
            </div>

            <div class="product-info">
                <h1>{{ $product->name }}</h1>

                <div class="product-meta">
                    <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="product-description">
                    <h3>Description</h3>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="product-actions">
                    @if(!empty($product->lynk_id_link))
                        <!-- Link to lynk.id checkout using the stored link -->
                        <a href="{{ $product->lynk_id_link }}"
                           class="btn btn-primary"
                           target="_blank">
                            Buy on lynk.id
                        </a>
                    @else
                        <p class="no-link-message">This product is not available for purchase yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection