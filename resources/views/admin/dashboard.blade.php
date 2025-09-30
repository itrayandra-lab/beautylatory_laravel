@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-header">
        <h1 class="dashboard-title">Welcome, {{ Auth::guard('admin')->user()->name }}!</h1>
        <p class="dashboard-subtitle">Here is a summary of your store.</p>
    </div>

    <div class="stat-cards-container">
        {{-- Stat Card for Products --}}
        <div class="stat-card">
            <div class="stat-card__info">
                <h3 class="stat-card__title">Total Products</h3>
                <p class="stat-card__number">{{ $productCount }}</p>
            </div>
            <div class="stat-card__icon">
                {{-- Simple icon using CSS --}}
                <span class="icon-box"></span>
            </div>
        </div>

        {{-- Stat Card for Categories --}}
        <div class="stat-card">
            <div class="stat-card__info">
                <h3 class="stat-card__title">Total Categories</h3>
                <p class="stat-card__number">{{ $categoryCount }}</p>
            </div>
            <div class="stat-card__icon">
                <span class="icon-list"></span>
            </div>
        </div>

        {{-- You can add more cards here --}}

    </div>
@endsection
