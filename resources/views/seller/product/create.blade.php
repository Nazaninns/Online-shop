<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Create Product</title>
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
        <h1 class="text-3xl font-bold">Create Product</h1>
        <div>
            <a href="/" class="text-blue-700 hover:underline">Home</a>
            <span class="mx-2">|</span>
            <a href="{{ route('logout') }}" class="text-blue-700 hover:underline">Logout</a>
        </div>
    </header>

    <section class="mt-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Add New Product</h2>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Product Name:</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                    <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Price:</label>
                    <input type="text" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Image:</label>
                    <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-bold mb-2">Category:</label>
                    <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Product</button>
                </div>
            </form>
        </div>
    </section>
</div>
</body>
</html>
