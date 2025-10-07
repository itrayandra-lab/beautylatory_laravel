@extends('admin.layouts.app')

@section('title', 'Articles Management')

@section('content')
    <div class="admin-page-header">
        <h1 class="admin-page-title">Articles Management</h1>
        <a href="{{ route('admin.articles.create') }}" class="btn btn--primary">Add New Article</a>
    </div>

    <div class="admin-card">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Published Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($article->image)
                                    <img src="{{ asset('images/articles/' . $article->image) }}" alt="{{ $article->title }}"
                                        class="table-image-preview">
                                @else
                                    <span class="no-image-placeholder">No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.articles.show', $article->id) }}" class="text-primary">
                                    {{ strlen($article->title) > 25 ? substr($article->title, 0, 25) . '...' : $article->title }}
                                </a>
                            </td>
                            <td>{{ $article->category->name }}</td>
                            <td>{{ $article->author->username }}</td>
                            <td>
                                <span class="badge {{ $article->status === 'published' ? 'badge--success' : 'badge--warning' }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn--secondary btn--small">Edit</a>
                                    <a href="{{ route('admin.articles.toggle-status', $article->id) }}" class="btn btn--{{ $article->status === 'published' ? 'warning' : 'success' }} btn--small">
                                        {{ $article->status === 'published' ? 'Unpublish' : 'Publish' }}
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger btn--small">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No articles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection