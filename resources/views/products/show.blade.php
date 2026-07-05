<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-pink-600 tracking-wide">Product Detail</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-16 px-4">
        <div class="bg-white rounded-xl shadow-md p-2 flex gap-3 items-center">
            {{-- Image --}}
            <div class="w-24 h-24 overflow-hidden rounded-xl flex-shrink-0">
                <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover">
            </div>

            {{-- Info --}}
            <div class="flex-1 flex flex-col justify-between">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-semibold truncate">{{ $product->name }}</h3>
                    @auth
                        <form action="{{ route('products.favorite', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm">
                                {{ auth()->user()->favorites->contains($product->id) ? '★' : '☆' }}
                            </button>
                        </form>
                    @endauth
                </div>
                <p class="text-pink-600 font-medium text-sm mt-1">${{ number_format($product->price) }}</p>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2 flex items-center gap-2">
                    @csrf
                    <input type="number" name="quantity" min="1" max="{{ $product->quantity }}" value="1"
                        class="w-16 border rounded px-2 py-1 text-center text-sm">
                    <button type="submit" class="bg-black text-white text-sm py-1 px-3 rounded hover:bg-gray-800">
                        Add to cart
                    </button>
                </form>
            </div>
        </div>

    </div>

</x-app-layout>
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-pink-600 tracking-wide">Product Detail</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-16 px-4">
        <div class="bg-white rounded-xl shadow-md p-2 flex gap-3 items-center">
            {{-- Image --}}
            <div class="w-24 h-24 overflow-hidden rounded-xl flex-shrink-0">
                <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover">
            </div>

            {{-- Info --}}
            <div class="flex-1 flex flex-col justify-between">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-semibold truncate">{{ $product->name }}</h3>
                    @auth
                        <form action="{{ route('products.favorite', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm">
                                {{ auth()->user()->favorites->contains($product->id) ? '★' : '☆' }}
                            </button>
                        </form>
                    @endauth
                </div>
                <p class="text-pink-600 font-medium text-sm mt-1">${{ number_format($product->price) }}</p>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2 flex items-center gap-2">
                    @csrf
                    <input type="number" name="quantity" min="1" max="{{ $product->quantity }}" value="1"
                        class="w-16 border rounded px-2 py-1 text-center text-sm">
                    <button type="submit" class="bg-black text-white text-sm py-1 px-3 rounded hover:bg-gray-800">
                        Add to cart
                    </button>
                </form>
            </div>
        </div>

    </div>

</x-app-layout>
>>>>>>> 77caff5170112a97dd06ec865221415c7d322d35
