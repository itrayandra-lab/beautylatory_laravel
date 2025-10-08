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


        /*
 * =========================================
 * === PAGINATION ===
 * =========================================
 */

        .pagination-container {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            margin: 0 0.25rem;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 0.75rem 1.25rem;
            color: var(--primary-color);
            background-color: var(--card-background);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination li a:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination li.active span {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            cursor: default;
        }

        .pagination li.disabled span {
            color: #ccc;
            cursor: not-allowed;
        }

        /*
 * Tailwind-style pagination markup support
 * Laravel's default paginator may output a Tailwind template
 * which uses utility classes that don't exist here. These rules
 * make it render nicely without Tailwind.
 */
        .pagination-container nav[role="navigation"] {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            width: 100%;
        }

        .pagination-container nav[role="navigation"]>div {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Hide the first Tailwind block (Prev/Next-only) to avoid duplication */
        .pagination-container nav[role="navigation"]>div:first-child {
            display: none !important;
        }

        /* Hide elements that Tailwind would hide */
        .pagination-container .hidden {
            display: none !important;
        }

        /* Ensure the numeric pager (hidden sm:flex) shows on all sizes */
        .pagination-container .hidden.sm\:flex {
            display: flex !important;
        }

        /* Screen-reader only text */
        .pagination-container .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Normalize item look (links and actionable spans only) */
        .pagination-container nav[role="navigation"] a,
        .pagination-container nav[role="navigation"] span[aria-current],
        .pagination-container nav[role="navigation"] span[aria-disabled] {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 0.9rem;
            color: var(--primary-color);
            background-color: var(--card-background);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination-container nav[role="navigation"] a:hover {
            background-color: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        .pagination-container nav[role="navigation"] .active>span {
            background-color: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        /* Fix giant SVG arrows (no Tailwind sizing) */
        .pagination-container nav[role="navigation"] svg {
            width: 1rem;
            height: 1rem;
        }

        /* Hide the default "Showing X to Y of Z results" text */
        .pagination-container nav[role="navigation"] p {
            display: none;
        }

        /* Minimal Tailwind-like utilities for pagination at >=640px */
        @media (min-width: 640px) {
            .pagination-container .sm\:inline {
                display: inline !important;
            }

            .pagination-container .sm\:block {
                display: block !important;
            }

            .pagination-container .sm\:flex {
                display: flex !important;
            }

            .pagination-container .sm\:flex-1 {
                flex: 1 1 0% !important;
            }

            .pagination-container .sm\:items-center {
                align-items: center !important;
            }

            .pagination-container .sm\:justify-between {
                justify-content: space-between !important;
            }

            /* Hide elements that should be hidden on sm and up */
            .pagination-container .sm\:hidden {
                display: none !important;
            }
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
                {{-- <a href="{{ route('admin.articles.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">Articles</a> --}}
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
