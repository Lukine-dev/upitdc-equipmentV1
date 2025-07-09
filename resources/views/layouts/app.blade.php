<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- AOS Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        html, body {
            scroll-behavior: smooth;
        }

        .parallax-section {
            background-image: url("{{ asset('storage/Images/main-bg.png') }}");
            height: 100vh;
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .parallax-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            z-index: 1;
        }

        .parallax-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .section {
            padding: 100px 0;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 40px 0;
        }

        .btn-main {
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 50px;
        }
    </style>
    

    @stack('styles')
</head>
<body>
    <div id="app" >
        {{-- NAVBAR --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="z-index: 10">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('storage/Images/itdc-logo.png') }}" alt="ITDC Logo" style="width: 3rem;">
            <span class="ms-2">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            {{-- Left side --}}
            <ul class="navbar-nav me-auto">
                {{-- Add left side nav links if needed --}}
            </ul>

            {{-- Right side --}}
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endif
                @else
                    @php $role = auth()->user()->role; @endphp

                    @if($role === 'administrator')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('admin/users*') ? 'active' : '' }}"
                               href="#" role="button" data-bs-toggle="dropdown">User Management</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">All Users</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users.create') }}">Add Admin/Editor</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/equipments*') ? 'active' : '' }}" href="{{ url('/admin/equipments') }}">Equipment Inventory</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/rentals*') ? 'active' : '' }}" href="{{ url('/admin/rentals') }}">Requests</a>
                        </li>
                    @endif

                    @if($role === 'editor')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('editors/equipments*') ? 'active' : '' }}" href="{{ url('/editors/equipments') }}">Manage Equipments</a>
                        </li>
                    @endif

                    @if($role === 'user')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('user/equipments*') ? 'active' : '' }}" href="{{ url('/user/equipments') }}">Browse Equipments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('user/rentals*') ? 'active' : '' }}" href="{{ url('/user/rentals') }}">My Rentals</a>
                        </li>
                    @endif

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>



        {{-- MAIN CONTENT --}}
        <main class="">
            @yield('content')
        </main>
        

        {{-- FOOTER --}}

    </div>

    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init({ once: true });</script>

    @stack('scripts')
</body>
</html>
