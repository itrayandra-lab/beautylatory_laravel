@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .dashboard-header h1 {
        font-size: 2.25rem;
        color: #2c3e50;
    }

    .dashboard-header p {
        margin: 0;
        color: #7f8c8d;
        font-size: 1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        border: 1px solid #ecf0f1;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #3498db;
        margin: 10px 0;
    }

    .stat-label {
        color: #7f8c8d;
        font-size: 1.1rem;
        text-transform: capitalize;
    }

    .admin-menu {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .menu-item {
        display: block;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        text-decoration: none;
        color: #2c3e50;
        border: 1px solid #ecf0f1;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }

    .menu-item h3 {
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .menu-item p {
        margin: 0;
        color: #7f8c8d;
    }

    @media (max-width: 575px) {
        .dashboard-header {
            align-items: flex-start;
        }

        .dashboard-header h1 {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="admin-container">
    <div class="dashboard-header">
        <div>
            <h1>Admin Dashboard</h1>
            <p>Welcome, {{ auth('admin')->user()->username ?? '' }}!</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ $productCount }}</div>
            <div class="stat-label">Products</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $categoryCount }}</div>
            <div class="stat-label">Categories</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $sliderCount }}</div>
            <div class="stat-label">Slider Items</div>
        </div>
    </div>

    <h2>Manage Content</h2>
    <div class="admin-menu">
        <a href="{{ route('admin.products.create') }}" class="menu-item">
            <h3>Products</h3>
            <p>Manage your products</p>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="menu-item">
            <h3>Categories</h3>
            <p>Manage product categories</p>
        </a>
        <a href="{{ route('admin.slider.index') }}" class="menu-item">
            <h3>Hero Slider</h3>
            <p>Manage homepage slider</p>
        </a>
    </div>
</div>
@endsection

