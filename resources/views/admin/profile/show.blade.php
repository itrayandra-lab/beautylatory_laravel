@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="profile-container">
    <h1>Admin Profile</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-info">
        <div class="profile-field">
            <strong>Username:</strong>
            <span>{{ $admin->username }}</span>
        </div>
        
        <div class="profile-field">
            <strong>Member Since:</strong>
            <span>{{ $admin->created_at->format('F j, Y') }}</span>
        </div>
    </div>
    
    <div class="profile-actions">
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
    </div>
</div>
@endsection