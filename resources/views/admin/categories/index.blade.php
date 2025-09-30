@extends('admin.layouts.app')

@section('title', 'Category Management')

@section('content')
<div class="admin-container">
    <h1>Category Management</h1>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    <div class="form-container">
        <h2>Add New Category</h2>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Category Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="slug">Category Slug *</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required>
                <small>Used in URLs (e.g., /products?category=slug)</small>
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>

    <h2>All Categories</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($categories))
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                    <td colspan="4">No categories found</td>
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
</style>
@endsection