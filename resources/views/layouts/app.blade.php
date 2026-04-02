<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<!-- Header/Navbar -->
<nav x-data="{ open: false, profileOpen: false }" class="fixed top-0 left-0 w-full z-50 bg-slate-900/95 backdrop-blur-md border-b border-slate-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 sm:h-16 items-center">
            <!-- Left: Logo & Main Nav -->
            <div class="flex items-center space-x-4 sm:space-x-8">
                <a href="/" class="flex items-center space-x-2">
                    <span class="text-lg sm:text-2xl font-bold tracking-tight text-white italic">Prem<span class="text-indigo-500">.in</span></span>
                </a>
                
                <div class="hidden md:flex items-center space-x-3 lg:space-x-4">
                    <a href="{{ route('home') }}" class="text-slate-300 hover:text-white text-xs sm:text-sm font-medium transition px-2 sm:px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('home') ? 'bg-slate-800 text-white' : '' }}">Home</a>
                    <a href="/products" class="text-slate-300 hover:text-white text-xs sm:text-sm font-medium transition px-2 sm:px-3 py-2 rounded-md hover:bg-slate-800">Shop</a>
                    <a href="/cart" class="text-slate-300 hover:text-white text-xs sm:text-sm font-medium transition px-2 sm:px-3 py-2 rounded-md hover:bg-slate-800 flex items-center">
                        <span class="hidden sm:inline">Cart</span>
                        <span class="ms-1 inline-flex items-center justify-center px-1.5 py-0.5 rounded-full text-xs font-bold bg-indigo-600 text-white leading-none">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>
                </div>
            </div>

            <!-- Right: Actions/User Menu -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 sm:space-x-3 text-slate-300 hover:text-white transition focus:outline-none bg-slate-800/50 pr-2 sm:pr-4 pl-1.5 py-1.5 rounded-full border border-slate-700 hover:border-slate-600 hover:bg-slate-700/50">
                            <div class="relative">
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-7 sm:h-8 w-7 sm:w-8 rounded-full object-cover border-2 border-slate-600 shadow-sm ring-2 ring-slate-500/20">
                                <div class="absolute -bottom-0.5 -right-0.5 h-3 w-3 bg-green-400 border-2 border-slate-800 rounded-full"></div>
                            </div>
                            <span class="hidden sm:inline text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Enhanced Dropdown Menu -->
                        <div x-show="profileOpen"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl py-3 border border-slate-100 ring-1 ring-black ring-opacity-5 z-50 text-slate-700"
                             style="display: none;">

                            <!-- Profile Header -->
                            <div class="px-4 py-3 border-b border-slate-100 mb-2">
                                <div class="flex items-center space-x-3">
                                    <div class="relative">
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-12 w-12 rounded-full object-cover border-2 border-slate-200 shadow-sm">
                                        <div class="absolute -bottom-0.5 -right-0.5 h-4 w-4 bg-green-400 border-2 border-white rounded-full"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                                        <div class="flex items-center mt-1">
                                            <div class="h-1.5 w-1.5 bg-green-400 rounded-full mr-1.5"></div>
                                            <span class="text-xs text-slate-500">Active now</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="px-2">
                                <a href="/dashboard" class="flex items-center space-x-3 px-3 py-2.5 text-sm hover:bg-slate-50 transition rounded-lg mx-1">
                                    <div class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Dashboard</span>
                                </a>

                                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2.5 text-sm hover:bg-slate-50 transition rounded-lg mx-1">
                                    <div class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-indigo-600">Profile Settings</span>
                                </a>

                                @if(auth()->user()->is_admin ?? false)
                                    <a href="/admin" class="flex items-center space-x-3 px-3 py-2.5 text-sm hover:bg-slate-50 transition rounded-lg mx-1 border-t border-slate-100 mt-2 pt-3">
                                        <div class="p-1.5 bg-purple-50 text-purple-600 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Admin Panel</span>
                                    </a>
                                @endif
                            </div>

                            <!-- Logout Section -->
                            <div class="border-t border-slate-100 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}" class="mx-2">
                                    @csrf
                                    <button type="submit" class="flex items-center space-x-3 w-full px-3 py-2.5 text-sm text-red-600 hover:bg-red-50 transition rounded-lg text-left">
                                        <div class="p-1.5 bg-red-50 text-red-600 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <a href="/login" class="text-slate-300 hover:text-white text-xs sm:text-sm font-medium px-2 sm:px-4 py-2 transition">Login</a>
                        <a href="/register" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs sm:text-sm font-semibold px-3 sm:px-5 py-2 rounded-lg transition shadow-md shadow-indigo-600/20">Register</a>
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
    <div x-show="open" class="md:hidden bg-slate-900 border-t border-slate-800 py-3 px-4 space-y-3 overflow-y-auto" style="display: none; max-height: calc(100vh - 3rem);">
        <a href="{{ route('home') }}" class="block text-slate-300 hover:text-white text-sm font-medium py-2 px-2 rounded hover:bg-slate-800 {{ request()->routeIs('home') ? 'text-white' : '' }}">Home</a>
        <a href="/products" class="block text-slate-300 hover:text-white text-sm font-medium py-2 px-2 rounded hover:bg-slate-800">Shop</a>
        <a href="/cart" class="block text-slate-300 hover:text-white text-sm font-medium py-2 px-2 rounded hover:bg-slate-800">
            Cart ({{ $cartCount ?? 0 }})
        </a>
        @auth
            <a href="/dashboard" class="block text-slate-300 hover:text-white text-sm font-medium py-2 px-2 rounded hover:bg-slate-800">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block text-indigo-400 hover:text-indigo-300 text-sm font-medium font-semibold py-2 px-2 rounded hover:bg-slate-800">Profile Settings</a>
        @else
            <a href="/login" class="block text-slate-300 hover:text-white text-sm font-medium py-2 px-2 rounded hover:bg-slate-800">Login</a>
            <a href="/register" class="block text-indigo-400 hover:text-indigo-300 text-sm font-bold py-2 px-2 rounded hover:bg-slate-800">Register</a>
        @endauth
    </div>
</nav>

<!-- Content -->

<div class="pt-14 sm:pt-16 mt-2 sm:mt-4">

@yield('content')
{{ $slot ?? '' }}

</div>

</body>
</html>
