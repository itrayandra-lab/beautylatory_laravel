<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! seo() !!}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
    <style>
        .nav-container {
            max-width: var(--container-width);
            margin: 0 auto;
        }


        /* Load More Button Styles */
        .load-more-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 2rem;
            padding: 1rem;
        }

        .loading-spinner {
            margin-top: 1rem;
            font-size: 1.2rem;
            color: var(--primary-color);
            text-align: center;
        }

        /* Product grid transition for smooth loading */
        .product-card {
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .product-card.loading {
            opacity: 0.6;
        }

        @media (max-width: 768px) {
            .hero__slider {
                height: auto;
            }

            .hero__image {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('images/asset-logo.png') }}" alt="logo"
                            width="68"></a>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">Products</a>
                    </li>
                    @auth('admin')
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="nav-link nav-link-button">Logout</button>
                            </form>
                        </li>
                    @endauth
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
