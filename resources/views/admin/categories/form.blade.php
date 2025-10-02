@extends('admin.layouts.app')

@section('title', isset($category) ? 'Edit Category' : 'Add New Category')

@section('content')
    <div class="admin-page-header">
        <h1 class="admin-page-title">{{ isset($category) ? 'Edit Category' : 'Add New Category' }}</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn--secondary">Back to Categories</a>
    </div>

    <div class="admin-card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
            method="POST" class="admin-form">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $category->name ?? '') }}" required>
            </div>

            <div class="form-actions">
                <button type="submit"
                    class="btn btn--primary">{{ isset($category) ? 'Update Category' : 'Save Category' }}</button>
            </div>
        </form>
    </div>
@endsection
