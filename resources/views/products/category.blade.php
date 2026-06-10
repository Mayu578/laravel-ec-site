<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ ucfirst($category) }} category products list
        </h2>
    </x-slot>
<br>

    <div class="max-w-screen-2xl mx-auto px-6">

        {{-- Product grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6 gap-4">


            @forelse ($products as $product)
                <div x-data="{ open: false }"
                    class="rounded-xl shadow-sm p-3 flex flex-col items-center hover:shadow-md transition w-full">

                    {{-- Image --}}
                    <div class="w-24 h-24 overflow-hidden rounded-lg mb-2">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-full object-cover cursor-pointer" @click="open = true">
                        @else
                            <div
                                class="w-full h-full bg-gray-100 flex items-center justify-center text-xs text-gray-400">
                                No image
                            </div>
                        @endif
                    </div>

                    {{-- Product info --}}
                    <h3 class="text-sm font-semibold truncate text-center mb-1">{{ $product->name }}</h3>
                    <p class="text-pink-500 text-xs font-medium mb-2">¥{{ number_format($product->price) }}</p>

                    {{-- Add to cart --}}
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="w-full">
                        @csrf
                        <div class="flex justify-center items-center gap-2 mb-2">
                            <input type="number" name="quantity" min="1" max="{{ $product->quantity }}"
                                value="1" class="w-16 border rounded px-2 py-1 text-center">
                        </div>

                        @if ($product->quantity > 0)
                            <button type="submit"
                                class="bg-pink-300 px-5 py-2 rounded-full hover:bg-pink-400 w-full transition-colors">
                                <i class="fa-solid fa-plus"></i> To Cart
                            </button>
                        @else
                            <button class="bg-gray-400 px-4 py-2 rounded cursor-not-allowed w-full" disabled>
                                Sold Out
                            </button>
                        @endif
                    </form>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">No Products</p>
            @endforelse

        </div>
        {{-- Back button --}}
        <a href="{{ route('products.index') }}"
            class="block mt-6 mx-auto max-w-xs bg-blue-500 text-center py-2 text-sm rounded hover:bg-blue-600">
            Go back to products page
        </a>

    </div>
</x-app-layout>
