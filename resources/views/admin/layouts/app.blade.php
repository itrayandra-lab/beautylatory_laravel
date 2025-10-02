<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Beautylatory</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .sidebar-link {
            display: block;
            padding: 1rem 1.5rem;
            margin: 12px 0;
            border-radius: var(--border-radius);
            color: #ecf0f1;
            text-decoration: none;
            transition: background-color 0.3s ease;
            -webkit-transition: background-color 0.3s ease;
            -moz-transition: background-color 0.3s ease;
            -ms-transition: background-color 0.3s ease;
            -o-transition: background-color 0.3s ease;
            -webkit-border-radius: var(--border-radius);
            -moz-border-radius: var(--border-radius);
            -ms-border-radius: var(--border-radius);
            -o-border-radius: var(--border-radius);
        }

        .sidebar-link:hover {
            background-color: #34495e;
        }

        .sidebar-link.active {
            background-color: var(--primary-color);
            font-weight: bold;
        }


        /*
 * =========================================
 * === ADMIN PROFILE PAGES ===
 * =========================================
 */

        .profile-container {
            background-color: var(--card-background);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
        }

        .profile-container h1 {
            margin-bottom: 1.5rem;
            color: var(--text-color);
        }

        .profile-info {
            margin-bottom: 2rem;
        }

        .profile-field {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .profile-field:last-child {
            border-bottom: none;
        }

        .profile-field strong {
            color: var(--text-color);
        }

        .profile-actions {
            margin-top: 2rem;
            text-align: center;
        }

        .profile-actions .btn {
            margin: 0 0.5rem;
        }
    </style>
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
                <a href="{{ route('admin.profile.show') }}"
                    class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">Profile</a>
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
