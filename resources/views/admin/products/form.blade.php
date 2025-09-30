@extends('admin.layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Add New Product')

@section('content')
    <div class="admin-page-header">
        <h1 class="admin-page-title">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn--secondary">Back to Products</a>
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

        <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
            method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            {{-- Form Fields --}}
            <div class="form-group">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $product->name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">-- Select a Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control"
                    value="{{ old('price', $product->price ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="link" class="form-label">Purchase Link (e.g., Lynk.id)</label>
                <input type="url" name="lynk_id_link" id="link" class="form-control"
                    value="{{ old('link', $product->link ?? '') }}" placeholder="https://lynk.id/your-product">
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" id="image" class="form-control" onchange="previewImage(event)">
            </div>

            <div class="form-actions">
                <button type="submit"
                    class="btn btn--primary">{{ isset($product) ? 'Update Product' : 'Save Product' }}</button>
            </div>
        </form>
    </div>
@endsection
