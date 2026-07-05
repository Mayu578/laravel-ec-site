<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-screen-2xl mx-auto px-6 py-2 flex justify-between items-center">

                    <div class="flex items-center justify-center h-full">
                        <div class="my-2 w-full max-w-xl">
                            <form action="{{ route('products.search') }}" method="GET">
                                <div class="flex">
                                    <input type="text" name="keyword" placeholder="Search products"
                                        class="w-full rounded-l-lg border-gray-300 focus:ring-pink-500 focus:border-pink-500">
                                    <button type="submit"
                                        class="bg-pink-600 px-3 rounded-r-lg hover:bg-pink-500 transition">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>




                    @if (auth()->check() && auth()->user()->is_admin)
                        <div class="space-x-2">
                            <a href="{{ route('admin.products.index') }}" class=" px-3 py-1   hover:text-gray-700">
                                Product Management
                            </a>
                            <a href="{{ route('admin.products.create') }}" class=" px-3 py-1   hover:text-gray-700">
                                Add Product
                            </a>
                            <a href="{{ route('admin.sections.create') }}" class=" px-3 py-1   hover:text-gray-700">
                                Add Section
                            </a>
                            <a href="{{ route('admin.sections.index') }}" class=" px-3 py-1   hover:text-gray-700">
                                Section Management
                            </a>
                        </div>
                    @endif

                    <!-- カートアイコン -->
                    @auth
                        @if (!auth()->user()->is_admin)
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') ?? 0;
                            @endphp

                            <a href="{{ route('cart.index') }}" class="relative">
                                <i class="fa-solid fa-basket-shopping hover:text-gray-700 "></i>

                                @if ($cartCount > 0)
                                    <span
                                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                        @endif
                    @endauth

                </div>
            </header>
        @endisset


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
