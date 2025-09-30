<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - BeautyLatory')</title>
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
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Visit Site</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </li>
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

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>

</html>

