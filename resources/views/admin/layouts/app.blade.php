<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Beautylatory</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="admin-body">
    <div class="admin-container">
        {{-- Sidebar Navigation --}}
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/asset-logo-white.png') }}" alt="Logo" class="sidebar-logo">
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.slider.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">Sliders</a>
                <a href="{{ route('admin.categories.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
                <a href="{{ route('admin.products.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
                <a href="{{ url('/') }}" target="_blank" class="sidebar-link">Visit Site</a>
            </nav>
            <div class="sidebar-footer">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="admin-main">
            <div class="admin-main__content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
