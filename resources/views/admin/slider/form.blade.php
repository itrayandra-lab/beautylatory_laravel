@extends('admin.layouts.app')

@section('title', isset($slider) ? 'Edit Slider' : 'Add New Slider')

@section('content')
    <div class="admin-page-header">
        <h1 class="admin-page-title">{{ isset($slider) ? 'Edit Slider' : 'Add New Slider' }}</h1>
        <a href="{{ route('admin.slider.index') }}" class="btn btn--secondary">Back to Sliders</a>
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

        <form action="{{ isset($slider) ? route('admin.slider.update', $slider->id) : route('admin.slider.store') }}"
            method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @if (isset($slider))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="image" class="form-label">Slider Image</label>
                <input type="file" name="image" id="image" class="form-control" onchange="previewImage(event)">
                <small class="form-text">Recommended size: 1200x500px</small>
            </div>

            <div class="form-group">
                <label for="order" class="form-label">Order</label>
                <input type="number" name="order" id="order" class="form-control"
                    value="{{ old('order', $slider->order ?? '') }}" required>
            </div>

            <div class="form-actions">
                <button type="submit"
                    class="btn btn--primary">{{ isset($slider) ? 'Update Slider' : 'Save Slider' }}</button>
            </div>
        </form>
    </div>
@endsection
