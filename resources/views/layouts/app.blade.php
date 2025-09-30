<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BeautyLatory')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('images/asset-logo.png') }}" alt="logo" width="68"></a>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">Products</a>
                    </li>
                    @if(session()->has('admin_id'))
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.logout') }}" class="nav-link">Logout</a>
                        </li>
                    @endif
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} BeautyLatory. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>