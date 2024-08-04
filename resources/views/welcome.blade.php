<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Online Shop</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-500 min-h-screen flex flex-col">
<!-- Navbar -->
<nav class="bg-blue-700 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-2xl font-bold">Online Shop</div>
        @if (Route::has('login'))
            <div class="flex space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-300">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<!-- Welcome Content -->
<div class="flex-grow flex items-center justify-center">
    <div class="text-center text-white p-8 bg-opacity-80 bg-blue-700 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-4">Welcome to Our Online Shop</h1>
        <p class="text-xl mb-6">Discover amazing products at unbeatable prices!</p>
        <a href="/shop" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Start Shopping</a>
    </div>
</div>
</body>
</html>
