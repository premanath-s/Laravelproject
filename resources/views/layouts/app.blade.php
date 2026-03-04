<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce App</title>

        <!-- Tailwind (quick dev CDN) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style> /* small utility to keep navbar buttons inline */
            .nav-actions > * { margin-right: .5rem; }
        </style>

</head>
<body>

<!-- Navbar -->

<nav class="fixed top-0 left-0 w-full z-50 bg-slate-800 border-b border-slate-700 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <a href="/" class="text-xl font-semibold text-white">Prem's Shop</a>
                <div class="ms-6 nav-actions">
                    <a href="/products" class="text-sm px-3 py-1 rounded bg-pink-700 text-gray-200 hover:bg-pink-600 hover:text-white">Shop</a>
                    <a href="/cart" class="text-sm px-3 py-1 rounded bg-yellow-500 text-black hover:bg-yellow-400">Cart</a>
                    @auth
                        @if(auth()->user()->is_admin ?? false)
                            <a href="/admin/products" class="text-sm px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-500">Admin</a>
                        @endif
                    @endauth
                </div>
            </div>

            <div>
                @auth
                    <a href="/dashboard" class="text-sm px-3 py-1 rounded bg-green-600 text-white hover:bg-green-500">Dashboard</a>
                    <form method="POST" action="/logout" style="display:inline;">
                        @csrf
                        <button class="text-sm px-3 py-1 rounded bg-red-600 text-white hover:bg-red-500">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="/login" class="text-sm px-3 py-1 rounded bg-blue-500 text-white hover:bg-blue-400">Login</a>
                    <a href="/register" class="text-sm px-3 py-1 rounded bg-emerald-500 text-white hover:bg-emerald-400">Register</a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Content -->

<div class=" pt-16 mt-4">

@yield('content')

</div>

</body>
</html>
