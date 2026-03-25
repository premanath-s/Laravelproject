<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce App</title>

    <!-- Tailwind (quick dev CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 for professional components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<!-- Header/Navbar -->
<nav x-data="{ open: false, profileOpen: false }" class="fixed top-0 left-0 w-full z-50 bg-slate-900/95 backdrop-blur-md border-b border-slate-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left: Logo & Main Nav -->
            <div class="flex items-center space-x-8">
                <a href="/" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold tracking-tight text-white italic">Bhovi<span class="text-indigo-500">.in</span></span>
                </a>
                
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-slate-300 hover:text-white text-sm font-medium transition px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('home') ? 'bg-slate-800 text-white' : '' }}">Home</a>
                    <a href="/products" class="text-slate-300 hover:text-white text-sm font-medium transition px-3 py-2 rounded-md hover:bg-slate-800">Shop</a>
                    <a href="/cart" class="text-slate-300 hover:text-white text-sm font-medium transition px-3 py-2 rounded-md hover:bg-slate-800 flex items-center">
                        Cart
                        <span class="ms-1.5 inline-flex items-center justify-center px-1.5 py-0.5 rounded-full text-xs font-bold bg-indigo-600 text-white leading-none">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>
                </div>
            </div>

            <!-- Right: Actions/User Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-3 text-slate-300 hover:text-white transition focus:outline-none bg-slate-800/50 pr-4 pl-1.5 py-1.5 rounded-full border border-slate-700 hover:border-slate-600">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full object-cover border border-slate-600 shadow-sm">
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl py-2 border border-slate-100 ring-1 ring-black ring-opacity-5 z-50 text-slate-700" 
                             style="display: none;">
                            
                            <div class="px-4 py-2 border-b border-slate-50 mb-1">
                                <p class="text-xs text-slate-400 font-medium">Logged in as</p>
                                <p class="text-sm font-semibold truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="/dashboard" class="block px-4 py-2 text-sm hover:bg-slate-50 transition">Dashboard</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-slate-50 transition font-medium text-indigo-600">Profile Settings</a>
                            
                            @if(auth()->user()->is_admin ?? false)
                                <a href="/admin" class="block px-4 py-2 text-sm hover:bg-slate-50 transition border-t border-slate-50 mt-1">Admin Panel</a>
                            @endif

                            <div class="border-t border-slate-50 mt-1">
                                <a href="/logout" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">Logout</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="/login" class="text-slate-300 hover:text-white text-sm font-medium px-4 py-2 transition">Login</a>
                        <a href="/register" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-5 py-2 rounded-lg transition shadow-md shadow-indigo-600/20">Register</a>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden text-slate-300 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="open ? 'hidden' : 'block'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="open ? 'block' : 'hidden'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div x-show="open" class="md:hidden bg-slate-900 border-t border-slate-800 py-4 px-6 space-y-4" style="display: none;">
        <a href="{{ route('home') }}" class="block text-slate-300 hover:text-white font-medium {{ request()->routeIs('home') ? 'text-white' : '' }}">Home</a>
        <a href="/products" class="block text-slate-300 hover:text-white font-medium">Shop</a>
        <a href="/cart" class="block text-slate-300 hover:text-white font-medium">
            Cart ({{ $cartCount ?? 0 }})
        </a>
        @auth
            <a href="/dashboard" class="block text-slate-300 hover:text-white font-medium">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block text-indigo-400 hover:text-indigo-300 font-medium font-semibold">Profile Settings</a>
        @else
            <a href="/login" class="block text-slate-300 hover:text-white font-medium">Login</a>
            <a href="/register" class="block text-indigo-400 hover:text-indigo-300 font-bold">Register</a>
        @endauth
    </div>
</nav>

<!-- Content -->

<div class=" pt-16 mt-4">

@yield('content')
{{ $slot ?? '' }}

</div>

</body>
</html>
