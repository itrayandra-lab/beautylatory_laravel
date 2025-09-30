@extends('admin.layouts.app')

@section('title', 'Slider Management')

@section('content')
<div class="admin-container">
    <h1>Slider Management</h1>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    <div class="form-container">
        <h2>Add New Slider Item</h2>
        <form method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="image">Slider Image *</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="order">Order *</label>
                <input type="number" id="order" name="order" value="{{ old('order') }}" min="1" required>
                <small>Lower numbers appear first (e.g., 1, 2, 3)</small>
            </div>

            <button type="submit" class="btn btn-primary">Add Slider Item</button>
        </form>
    </div>

    <h2>All Slider Items</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Order</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($sliders))
                @foreach($sliders as $slider)
                    <tr>
                        <td>
                            @if(!empty($slider->image))
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider image" class="slider-image">
                            @else
                                <div class="no-image">No Image</div>
                            @endif
                        </td>
                        <td>{{ $slider->order }}</td>
                        <td>{{ $slider->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.slider.destroy', $slider->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this slider item?');">
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
                    <td colspan="4">No slider items found</td>
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

    .slider-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .no-image {
        width: 80px;
        height: 60px;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        color: #6c757d;
        font-size: 0.8rem;
    }
</style>
@endsection