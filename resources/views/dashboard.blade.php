<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2> --}}
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto">
            <div class="relative bg-gray-100 rounded-lg overflow-hidden mb-12 p-8 text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Welcome, {{ auth()->user()->name }}！</h1>
                <p class="text-gray-700 text-lg max-w-2xl mx-auto">
                    We offer carefully selected Scandinavian furniture and lifestyle products inspired by Nordic design.
                    Our collection blends simplicity, warmth, and functionality to bring timeless European style into
                    your home.
                </p>
            </div>
            <h2 class="text-3xl font-bold mt-12 mb-4 border-b-2 border-gray-300 pb-2">
                <a href="{{ route('products.index') }}">
                    Shop All Products
                </a>
            </h2>

            {{-- 🔽 ここは max-w-7xl の外 --}}
            {{-- 1. All Products (すべての商品) --}}
            <div class="w-full overflow-x-auto scroll-smooth pb-2" style="-webkit-overflow-scrolling: touch;">
                <div class="flex gap-4 w-max pr-4">
                    @foreach ($allProducts as $product)
                        <a href="{{ route('products.show', $product) }}" class="shrink-0">
                            <img src="{{ Storage::url($product->image) }}"
                                class="w-40 h-40 rounded-lg object-cover hover:brightness-90 transition-all shadow-sm">
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- 2. Furniture (家具) --}}
            <h2 class="text-3xl font-bold mt-12 mb-4 border-b-2 border-gray-300 pb-2">
                <a href="{{ route('products.category', 'furniture') }}" class="hover:text-gray-600">Furniture</a>
            </h2>
            <div class="w-full overflow-x-auto scroll-smooth pb-2" style="-webkit-overflow-scrolling: touch;">
                <div class="flex gap-4 w-max pr-4"> {{-- justify-end を外して左から綺麗にスクロールさせます --}}
                    @foreach ($furnitureProducts as $product)
                        <a href="{{ route('products.show', $product) }}" class="shrink-0">
                            <img src="{{ Storage::url($product->image) }}"
                                class="w-40 h-40 rounded-lg object-cover hover:brightness-90 transition-all shadow-sm">
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- 3. Lifestyle (ライフスタイル) --}}
            <h2 class="text-3xl font-bold mt-12 mb-4 border-b-2 border-gray-300 pb-2">
                <a href="{{ route('products.category', 'lifestyle') }}" class="hover:text-gray-600">Lifestyle</a>
            </h2>
            <div class="w-full overflow-x-auto scroll-smooth pb-2" style="-webkit-overflow-scrolling: touch;">
                <div class="flex gap-4 w-max pr-4">
                    @foreach ($lifestyleProducts as $product)
                        <a href="{{ route('products.show', $product) }}" class="shrink-0">
                            <img src="{{ Storage::url($product->image) }}"
                                class="w-40 h-40 rounded-lg object-cover hover:brightness-90 transition-all shadow-sm">
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

</x-app-layout>
