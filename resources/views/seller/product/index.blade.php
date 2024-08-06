<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Product Index</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
<!-- Sidebar -->
<aside class="w-64 bg-blue-700 text-white min-h-screen">
    <div class="p-4 text-2xl font-bold">
        Seller Dashboard
    </div>
    <nav class="mt-6">
        <ul>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Dashboard</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="{{ route('products.index') }}">My Products</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Sales</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Orders</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Customers</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Reports</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="#">Settings</a></li>
            <li class="px-4 py-2 hover:bg-blue-600"><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </nav>
</aside>

<!-- Main Content -->
<div class="flex-1 p-6">
    <header class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Products</h1>
        <div>
            <a href="/" class="text-blue-700 hover:underline">Home</a>
            <span class="mx-2">|</span>
            <a href="{{ route('logout') }}" class="text-blue-700 hover:underline">Logout</a>
        </div>
    </header>

    <section class="mt-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Product List</h2>
                <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Product</a>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Product ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Stock</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
{{--                @foreach($products as $product)--}}
{{--                    <tr>--}}
{{--                        <td class="py-2 px-4 border-b">{{ $product->id }}</td>--}}
{{--                        <td class="py-2 px-4 border-b">{{ $product->name }}</td>--}}
{{--                        <td class="py-2 px-4 border-b">${{ $product->price }}</td>--}}
{{--                        <td class="py-2 px-4 border-b">{{ $product->stock }}</td>--}}
{{--                        <td class="py-2 px-4 border-b">--}}
{{--                            <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>--}}
{{--                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
                </tbody>
            </table>
        </div>
    </section>
</div>
</body>
</html>
