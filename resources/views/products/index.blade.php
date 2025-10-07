@extends('layouts.app')

@section('title', 'All Products')

@section('content')
    <div class="products-page">
        <section class="page-header">
            <div class="container">
                <h1 class="page-header__title">All Products</h1>
            </div>
        </section>

        <!-- Category Filter Section -->
        <section class="category-filter-section">
            <div class="container">
                <div class="category-filter-buttons">
                    <a href="{{ route('products.index') }}" class="category-btn {{ request()->get('category') ? '' : 'active' }}">All Products</a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}"
                           class="category-btn {{ request()->get('category') == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="products-grid-section">
            <div class="container">
                <div class="products-grid" id="products-grid">
                    @forelse($products as $product)
                        <div class="product-card">
                            <a href="{{ route('products.show', $product->id) }}" class="product-card__link">
                                <div class="product-card__image-container">
                                    @if (!empty($product->image))
                                        <img src="{{ asset($product->image) }}" loading="lazy" alt="{{ $product->name }}"
                                            class="product-card__image">
                                    @else
                                        <div class="product-card__no-image">No Image</div>
                                    @endif
                                </div>
                                <div class="product-card__info">
                                    <h3 class="product-card__name">{{ $product->name }}</h3>
                                    <p class="product-card__price">
                                        @if($product->discount_price && $product->discount_price < $product->price)
                                            <span class="original-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            <span class="discounted-price">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                        @else
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="products-grid__empty">No products found.</p>
                    @endforelse
                </div>

                @if($products->hasMorePages())
                    <div class="load-more-container">
                        <button id="load-more-btn" class="btn btn--primary" data-page="2" data-category="{{ request()->get('category') }}">
                            Load More
                        </button>
                        <div id="loading-spinner" class="loading-spinner" style="display: none;">
                            Loading...
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('load-more-btn');
            const productsGrid = document.getElementById('products-grid');
            const loadingSpinner = document.getElementById('loading-spinner');
            
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    const page = parseInt(this.getAttribute('data-page'));
                    const category = this.getAttribute('data-category');
                    
                    loadMoreBtn.style.display = 'none';
                    loadingSpinner.style.display = 'block';
                    
                    fetch('{{ route("products.load-more") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            page: page,
                            category: category
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.products && data.products.length > 0) {
                            data.products.forEach(product => {
                                const productCard = document.createElement('div');
                                productCard.className = 'product-card';
                                productCard.innerHTML = `
                                    <a href="/products/${product.id}" class="product-card__link">
                                        <div class="product-card__image-container">
                                            ${product.image ?
                                                `<img src="${product.image}" loading="lazy" alt="${product.name}" class="product-card__image">` :
                                                '<div class="product-card__no-image">No Image</div>'
                                            }
                                        </div>
                                        <div class="product-card__info">
                                            <h3 class="product-card__name">${product.name}</h3>
                                            <p class="product-card__price">
                                                ${product.discount_price && product.discount_price < product.price ?
                                                    `<span class="original-price">Rp ${product.price.toLocaleString('id-ID')}</span> <span class="discounted-price">Rp ${product.discount_price.toLocaleString('id-ID')}</span>` :
                                                    `Rp ${product.price.toLocaleString('id-ID')}`
                                                }
                                            </p>
                                        </div>
                                    </a>
                                `;
                                productsGrid.appendChild(productCard);
                            });
                            
                            if (data.hasMorePages) {
                                loadMoreBtn.setAttribute('data-page', page + 1);
                                loadMoreBtn.style.display = 'block';
                            } else {
                                loadMoreBtn.style.display = 'none';
                                const endMessage = document.createElement('p');
                                endMessage.className = 'products-grid__empty';
                                endMessage.textContent = 'No more products to load.';
                                productsGrid.appendChild(endMessage);
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error loading more products:', error);
                        loadMoreBtn.style.display = 'block';
                    })
                    .finally(() => {
                        loadingSpinner.style.display = 'none';
                    });
                });
            }
        });
    </script>
@endsection
