<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
<!-- Sidebar -->
<aside class="w-64 bg-blue-700 text-white min-h-screen">
    <div class="p-4 text-2xl font-bold">
        Admin Dashboard
    </div>
    <nav class="mt-6">
        <ul>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Dashboard</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Products</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Orders</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Customers</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Reports</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Settings</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Logout</a></li>
        </ul>
    </nav>
</aside>

<!-- Main Content -->
<div class="flex-1 p-6">
    <header class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <div>
            <a href="/" class="text-blue-700 hover:underline">Home</a>
            <span class="mx-2">|</span>
            <form action="{{route('logout') }}" method="post">
                @csrf
            <button type="submit" class="text-blue-700 hover:underline">Logout</button>
            </form>
        </div>
    </header>

    <section class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Dashboard Cards -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold">Total Products</h2>
                <p class="mt-2 text-gray-600">100</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold">Total Orders</h2>
                <p class="mt-2 text-gray-600">250</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold">Total Customers</h2>
                <p class="mt-2 text-gray-600">150</p>
            </div>
            <!-- Add more cards as needed -->
        </div>
    </section>

    <section class="mt-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Recent Orders</h2>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Order ID</th>
                    <th class="py-2 px-4 border-b">Customer</th>
                    <th class="py-2 px-4 border-b">Amount</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">1</td>
                    <td class="py-2 px-4 border-b">John Doe</td>
                    <td class="py-2 px-4 border-b">$100.00</td>
                    <td class="py-2 px-4 border-b">Completed</td>
                </tr>
                <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </section>
</div>
</body>
</html>

