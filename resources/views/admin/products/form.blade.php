@extends('admin.layouts.app')

@if(isset($product))
    @section('title', 'Edit Product')
@else
    @section('title', 'Add Product')
@endif

@section('content')
<div class="admin-container">
    <h1>Product Management</h1>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    <div class="form-container">
        <h2>{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h2>
        <form method="POST" 
              action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" 
              enctype="multipart/form-data">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Product Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category *</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ (isset($product) && $product->category_id == $category->id) || old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price *</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" required>{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                @if(isset($product) && $product->image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current image" class="product-image">
                    </div>
                    <input type="hidden" name="existing_image" value="{{ $product->image }}">
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                <small>Leave empty to keep current image</small>
                @if(isset($product) && $product->image)
                    <div style="margin-top: 10px;">
                        <label>
                            <input type="checkbox" name="remove_image" value="1"> Remove current image
                        </label>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="lynk_id_link">Lynk.id Checkout Link</label>
                <input type="url" id="lynk_id_link" name="lynk_id_link" 
                       value="{{ old('lynk_id_link', $product->lynk_id_link ?? '') }}" 
                       placeholder="https://lynk.id/checkout/shipping?token=...">
                <small>Enter the lynk.id checkout link for this product</small>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($product) ? 'Update Product' : 'Add Product' }}
            </button>

            @if(isset($product))
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            @endif
        </form>
    </div>

    <h2>All Products</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($products))
                @foreach($products as $product)
                    <tr>
                        <td>
                            @if(!empty($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                <div class="no-image">No Image</div>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No products found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection

@section('styles')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .form-container {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0.1);
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    .form-group textarea {
        height: 120px;
        resize: vertical;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-secondary {
        background-color: #95a5a6;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
    }

    .message {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .message.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .message.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0.1);
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #2c3e50;
    }

    tr:hover {
        background-color: #f8f9fa;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .no-image {
        width: 60px;
        height: 60px;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        color: #6c757d;
        font-size: 0.8rem;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }
</style>
@endsection