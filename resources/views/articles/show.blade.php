@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <article class="article-detail">
                <div class="article-header mb-4">
                    <h1 class="article-title">{{ $article->title }}</h1>
                    
                    <div class="article-meta mt-3">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="article-author me-3">
                                <i class="fas fa-user"></i>
                                By <span class="fw-bold">{{ $article->author->username }}</span>
                            </div>
                            <div class="article-date me-3">
                                <i class="fas fa-calendar"></i>
                                {{ $article->published_at->format('F d, Y') }}
                            </div>
                            <div class="article-category">
                                <i class="fas fa-folder"></i>
                                <a href="{{ route('guest.articles.index', ['category' => $article->category->slug]) }}" class="text-decoration-none">
                                    {{ $article->category->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if($article->image)
                <div class="article-image mb-4">
                    <img src="{{ asset('images/articles/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid rounded">
                </div>
                @endif

                <div class="article-content">
                    {!! $article->content !!}
                </div>

                @if($article->tags->count() > 0)
                <div class="article-tags mt-4">
                    <h5 class="mb-3">Tags:</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                        <a href="{{ route('guest.articles.index', ['tag' => $tag->slug]) }}" class="btn btn-outline-primary btn-sm">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                @endif

                <div class="article-share mt-5">
                    <h5 class="mb-3">Share this article:</h5>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" class="btn btn-info btn-sm text-white">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </article>

            <div class="related-articles mt-5">
                <h3>Related Articles</h3>
                <div class="row">
                    <!-- Related articles would be displayed here -->
                    <div class="col-12">
                        <p class="text-muted">Related articles section would appear here based on category or tags.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('seo')
    {!! seo($article) !!}
@endsection