@extends('admin.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="profile-container">
    <h1>Edit Profile</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $admin->username) }}" required>
            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" id="password" name="password" class="form-control">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ route('admin.profile.show') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection