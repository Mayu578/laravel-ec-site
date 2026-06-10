<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-pink-600">
            Favorite Products
        </h2>
    </x-slot>
    {{-- Back button --}}
    <a href="{{ route('products.index') }}" class="text-sm text-gray-400 hover:text-pink-500 mt-auto　ms-6 text-center">
        ←Back to product list
    </a>

    <div class="py-12 bg-pink-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($favorites->isEmpty())
                <p class="text-gray-500 text-center">
                    No favorite products yet.
                </p>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                    @foreach ($favorites as $product)
                        <div
                            class="bg-white rounded-2xl shadow hover:shadow-lg transition-transform transform hover:scale-105 flex flex-col overflow-hidden relative">

                            {{-- Favorite star --}}
                            <form method="POST" action="{{ route('products.favorite', $product) }}"
                                class="absolute top-3 right-3 z-10">
                                @csrf
                                <button class="text-yellow-400 text-2xl">
                                    ★
                                </button>
                            </form>

                            {{-- image --}}
                            @if ($product->image)
                                <div
                                    class="w-full h-40 mb-4 overflow-hidden rounded-t-2xl flex items-center justify-center bg-gray-50">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="h-full object-contain">
                                </div>
                            @endif

                            {{-- product name --}}
                            <h3 class="font-serif text-md text-center mb-2 line-clamp-2 px-2">
                                {{ $product->name }}
                            </h3>

                            {{-- price --}}
                            <p class="text-pink-500 font-semibold text-center mb-3">
                                ${{ number_format($product->price) }}
                            </p>

                            {{-- Cart --}}
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-auto px-4 pb-4">
                                @csrf

                                <div class="flex items-center gap-2 mb-3">
                                    <label for="quantity-{{ $product->id }}" class="text-sm text-gray-600">
                                        Qty
                                    </label>

                                    <input id="quantity-{{ $product->id }}" type="number" name="quantity"
                                        min="1" max="{{ $product->quantity }}" value="1"
                                        class="w-16 border rounded px-2 py-1 text-center">

                                    <span class="text-sm text-gray-500">
                                        / {{ $product->quantity }} stocks
                                    </span>
                                </div>

                                @if ($product->quantity <= 0)
                                    <button type="button" disabled
                                        class="w-full bg-gray-300 text-gray-600 py-2 rounded cursor-not-allowed">
                                        Sold Out
                                    </button>
                                @else
                                    <button type="submit"
                                        class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                                        Add to cart
                                    </button>
                                @endif
                            </form>

                        </div>
                    @endforeach
                </div>

            @endif

        </div>
    </div>

</x-app-layout>
