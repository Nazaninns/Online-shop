<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home - All Products</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
<!-- Sidebar -->
<aside class="w-64 bg-blue-700 text-white min-h-screen">
    <div class="p-4 text-2xl font-bold">
        <span>welcome</span>
        <span class="text-blue-200">
{{--            @dd(\Illuminate\Support\Facades\Auth::guard('admin')->check())--}}
            @if(\Illuminate\Support\Facades\Auth::guard('customer')->check())
                @php $user = \Illuminate\Support\Facades\Auth::guard('customer')->user(); @endphp
                {{$user->firstname.' '.$user->lastname}}
            @endif
            @if(\Illuminate\Support\Facades\Auth::guard('seller')->check())
                @php $user = \Illuminate\Support\Facades\Auth::guard('seller')->user(); @endphp
                {{$user->firstname.' '.$user->lastname}}
            @endif
            @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                @php $user = \Illuminate\Support\Facades\Auth::guard('admin')->user(); @endphp
                {{$user->firstname.' '.$user->lastname}}
            @endif
        </span>
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
            {{--            <li class="px-4 py-2 hover:bg-blue-600"><a href="{{ route('logout') }}">Logout</a></li>--}}
        </ul>
    </nav>
</aside>

<!-- Main Content -->
<div class="flex-1 flex flex-col">
    <!-- Header -->
    <header class="bg-indigo-500 text-white p-8">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Product Store</h1>
            <nav>
                <a href="/" class="text-white hover:underline mx-2">Home</a>
                @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                    @php $prefix = 'admin.' @endphp
                @elseif(\Illuminate\Support\Facades\Auth::guard('seller')->check())
                    @php $prefix = 'seller.' @endphp
                @elseif(\Illuminate\Support\Facades\Auth::guard('customer')->check())
                    @php $prefix = 'customer.' @endphp
                @endif
                @if(isset($prefix))
                <form action="{{route($prefix.'logout')}}" method="post">
                    @csrf
                    <button type="submit" class="text-white hover:underline mx-2">Logout</button>
                </form>
                @endif
            </nav>
        </div>
    </header>

    <!-- Product List -->
    <main class="container mx-auto p-6 flex-1">
        <h2 class="text-3xl font-bold mb-6">Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-600">${{ $product->price }}</p>

                    <!-- Quantity Input Form -->
                    <form action="{{route('cart.store')}}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center">
                            <input type="number" name="quantity" min="1" value="1" class="border p-2 rounded mr-2 w-16">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add
                                to Cart
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('products.show', $product->id) }}"
                       class="text-blue-500 hover:underline mt-2 block">View Details</a>
                </div>
            @endforeach
        </div>
    </main>
</div>
</body>
</html>
