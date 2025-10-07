@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Articles</h1>
        </div>
    </div>

    <div class="row">
        <!-- Articles List -->
        <div class="col-9">
            <div class="row">
                @forelse($articles as $article)
                <div class="col-6 col-lg-4 mb-4">
                    <div class="product-card article-card">
                        @if($article->image)
                        <img src="{{ asset('images/articles/' . $article->image) }}" class="product-image" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="product-info">
                            <h3 class="product-name">
                                <a href="{{ route('guest.articles.show', $article->slug) }}" class="text-decoration-none">
                                    {{ Str::limit($article->title, 40) }}
                                </a>
                            </h3>
                            <p class="product-description">
                                {{ Str::limit(strip_tags($article->content), 10) }}
                            </p>
                            <div class="product-meta">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> {{ $article->author->username }} |
                                        <i class="fas fa-calendar"></i> {{ $article->published_at->format('M d, Y') }}
                                    </small>
                                    <a href="{{ route('guest.articles.show', $article->slug) }}" class="btn btn-primary btn-sm">Read More</a>
                                </div>
                                <div class="mt-2">
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-folder"></i> {{ $article->category->name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="col-12">
                    <p class="text-center">No articles found.</p>
                </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-3">
            <div class="product-card">
                <div class="product-info">
                    <h4>Categories</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('guest.articles.index') }}" class="text-decoration-none">All Articles</a></li>
                        @php
                            $categories = \App\Models\Category::withCount('articles')->get();
                        @endphp
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('guest.articles.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                                {{ $category->name }} <span class="badge bg-secondary">{{ $category->articles_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection