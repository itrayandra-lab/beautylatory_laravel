@extends('admin.layouts.app')

@section('title', 'Sliders Management')

@section('content')
    <div class="admin-page-header">
        <h1 class="admin-page-title">Sliders Management</h1>
        <a href="{{ route('admin.slider.create') }}" class="btn btn--primary">Add New Slider</a>
    </div>

    <div class="admin-card">
        @if (session('success'))
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
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image"
                                    class="table-image-preview">
                            </td>
                            <td>{{ $slider->order }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                        class="btn btn--secondary btn--small">Edit</a>
                                    <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this slider?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger btn--small">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No sliders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
