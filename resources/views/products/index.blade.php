<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-pink-600 tracking-wide">Product List</h2>
    </x-slot>

    <div class="py-4 bg-pink-50">

        <!-- Category（上） -->
        <aside class="rounded-xl shadow-md p-2">
            <h3 class="font-serif text-lg text-pink-500 mb-3">Category</h3>
            <ul class="flex flex-wrap gap-3">
                @foreach ($sections->unique('category') as $section)
                    <li>
                        <a href="{{ route('products.category', $section->category) }}"
                            class="px-4 py-2 rounded-full bg-pink-50 hover:bg-pink-200 text-gray-700 text-sm">
                            {{ $section->category }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>



        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div onclick="openModal({{ $product->id }})"
                    class="bg-white rounded-xl shadow hover:shadow-lg cursor-pointer overflow-hidden">

                    <img src="{{ Storage::url($product->image) }}" class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500">
                            ${{ number_format($product->price) }}
                        </p>
                        @auth
                            <form action="{{ route('products.favorite', $product) }}" method="POST"
                                onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" class="text-lg　text-right">
                                    {{ auth()->user()->favorites->contains($product->id) ? '★' : '☆' }}
                                </button>
                            </form>
                        @endauth
                        <form action="{{ route('cart.add', $product) }}" method="POST"
                            onclick="event.stopPropagation();" class="mt-4">
                            @csrf

                            <div class="flex items-center gap-3">
                                <label for="quantity-{{ $product->id }}" class="text-sm text-gray-600">
                                    Quantity
                                </label>

                                <input id="quantity-{{ $product->id }}" type="number" name="quantity" min="1"
                                    max="{{ $product->quantity }}" value="1"
                                    class="w-20 border rounded px-2 py-1 text-center" />

                                <span class="text-sm text-gray-500">
                                    / {{ $product->quantity }} Stocks
                                </span>
                            </div>

                            {{-- 在庫切れ --}}
                            @if ($product->quantity <= 0)
                                <button type="button" disabled
                                    class="mt-3 w-full bg-gray-300 text-gray-600 py-2 rounded cursor-not-allowed">
                                    Sold Out
                                </button>
                            @else
                                <button type="submit"
                                    class="mt-3 w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                                    Add to cart
                                </button>
                            @endif
                        </form>


                    </div>

                </div>
            @endforeach
        </div>

        {{-- Modal Background --}}
        <div id="product-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
            onclick="closeModal()">
            {{-- Modal Content --}}
            <div class="bg-white rounded-2xl w-full max-w-md p-6 " onclick="event.stopPropagation();">
                {{-- Close --}}
                <button onclick="closeModal()"
                    class="top-3 right-3 z-20 text-gray-500 hover:text-black text-2xl">
                    ×
                </button>

                {{-- Product Image --}}
                
                    <img id="modal-image" src="" class="w-20 h-20 object-cover rounded-xl" />


                    {{-- Favorite --}}
                    {{-- Favorite --}}
                    @auth
                        <form id="modal-favorite-form" method="POST" class="text-left top-3 right-3 z-20">
                            @csrf
                            <button type="submit" onclick="event.stopPropagation();"
                                class="text-2xl bg-white/80 rounded-full px-2 py-1">
                                <span id="modal-favorite">☆</span>
                            </button>
                        </form>
                    @endauth
                

                {{-- Product Info --}}
                <div class="mt-4">
                    <h2 id="modal-name" class="text-xl font-bold"></h2>
                    <p id="modal-price" class="text-gray-600 mt-1"></p>

                    <p id="modal-description" class="text-sm text-gray-500 mt-3 leading-relaxed"></p>
                </div>

                {{-- Cart --}}
                <form id="modal-cart-form" method="POST" class="mt-6">
                    @csrf

                    <div class="flex items-center gap-3">
                        <label class="text-sm text-gray-600">Quantity</label>

                        <input id="modal-quantity" type="number" name="quantity" min="1"
                            class="w-20 border rounded px-2 py-1 text-center" />

                        <span id="modal-stock" class="text-sm text-gray-500"></span>
                    </div>

                    <button id="modal-cart-button" type="submit"
                        class="mt-4 w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                        Add to cart
                    </button>
                </form>
            </div>
        </div>

        {{-- JS --}}
        <script>
            const products = @json($products->keyBy('id'));

            function openModal(id) {
                const product = products[id];

                document.getElementById('modal-image').src = product.image_url;
                document.getElementById('modal-name').innerText = product.name;
                document.getElementById('modal-price').innerText =
                    '$' + Number(product.price).toLocaleString();
                document.getElementById('modal-description').innerText =
                    product.description ?? '';

                // Quantity
                const quantityInput = document.getElementById('modal-quantity');
                quantityInput.max = product.quantity;
                quantityInput.value = 1;

                document.getElementById('modal-stock').innerText =
                    `/ stocks ${product.quantity}`;

                // Cart form
                document.getElementById('modal-cart-form').action =
                    `/cart/add/${product.id}`;

                // Favorite
                @auth
                document.getElementById('modal-favorite-form').action =
                    `/products/${product.id}/favorite`;
                document.getElementById('modal-favorite').innerText =
                    product.is_favorite ? '★' : '☆';
            @endauth

            document.getElementById('product-modal').classList.remove('hidden');
            document.getElementById('product-modal').classList.add('flex');
            }

            function closeModal() {
                document.getElementById('product-modal').classList.add('hidden');
                document.getElementById('product-modal').classList.remove('flex');
            }
        </script>
        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $products->links() }}
        </div>

    </div>
   
</x-app-layout>
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-pink-600 tracking-wide">Product List</h2>
    </x-slot>

    <div class="py-4 bg-pink-50">

        <!-- Category（上） -->
        <aside class="rounded-xl shadow-md p-2">
            <h3 class="font-serif text-lg text-pink-500 mb-3">Category</h3>
            <ul class="flex flex-wrap gap-3">
                @foreach ($sections->unique('category') as $section)
                    <li>
                        <a href="{{ route('products.category', $section->category) }}"
                            class="px-4 py-2 rounded-full bg-pink-50 hover:bg-pink-200 text-gray-700 text-sm">
                            {{ $section->category }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>



        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div onclick="openModal({{ $product->id }})"
                    class="bg-white rounded-xl shadow hover:shadow-lg cursor-pointer overflow-hidden">

                    <img src="{{ Storage::url($product->image) }}" class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500">
                            ${{ number_format($product->price) }}
                        </p>
                        @auth
                            <form action="{{ route('products.favorite', $product) }}" method="POST"
                                onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" class="text-lg　text-right">
                                    {{ auth()->user()->favorites->contains($product->id) ? '★' : '☆' }}
                                </button>
                            </form>
                        @endauth
                        <form action="{{ route('cart.add', $product) }}" method="POST"
                            onclick="event.stopPropagation();" class="mt-4">
                            @csrf

                            <div class="flex items-center gap-3">
                                <label for="quantity-{{ $product->id }}" class="text-sm text-gray-600">
                                    Quantity
                                </label>

                                <input id="quantity-{{ $product->id }}" type="number" name="quantity" min="1"
                                    max="{{ $product->quantity }}" value="1"
                                    class="w-20 border rounded px-2 py-1 text-center" />

                                <span class="text-sm text-gray-500">
                                    / {{ $product->quantity }} Stocks
                                </span>
                            </div>

                            {{-- 在庫切れ --}}
                            @if ($product->quantity <= 0)
                                <button type="button" disabled
                                    class="mt-3 w-full bg-gray-300 text-gray-600 py-2 rounded cursor-not-allowed">
                                    Sold Out
                                </button>
                            @else
                                <button type="submit"
                                    class="mt-3 w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                                    Add to cart
                                </button>
                            @endif
                        </form>


                    </div>

                </div>
            @endforeach
        </div>

        {{-- Modal Background --}}
        <div id="product-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
            onclick="closeModal()">
            {{-- Modal Content --}}
            <div class="bg-white rounded-2xl w-full max-w-md p-6 " onclick="event.stopPropagation();">
                {{-- Close --}}
                <button onclick="closeModal()"
                    class="top-3 right-3 z-20 text-gray-500 hover:text-black text-2xl">
                    ×
                </button>

                {{-- Product Image --}}
                
                    <img id="modal-image" src="" class="w-20 h-20 object-cover rounded-xl" />


                    {{-- Favorite --}}
                    {{-- Favorite --}}
                    @auth
                        <form id="modal-favorite-form" method="POST" class="text-left top-3 right-3 z-20">
                            @csrf
                            <button type="submit" onclick="event.stopPropagation();"
                                class="text-2xl bg-white/80 rounded-full px-2 py-1">
                                <span id="modal-favorite">☆</span>
                            </button>
                        </form>
                    @endauth
                

                {{-- Product Info --}}
                <div class="mt-4">
                    <h2 id="modal-name" class="text-xl font-bold"></h2>
                    <p id="modal-price" class="text-gray-600 mt-1"></p>

                    <p id="modal-description" class="text-sm text-gray-500 mt-3 leading-relaxed"></p>
                </div>

                {{-- Cart --}}
                <form id="modal-cart-form" method="POST" class="mt-6">
                    @csrf

                    <div class="flex items-center gap-3">
                        <label class="text-sm text-gray-600">Quantity</label>

                        <input id="modal-quantity" type="number" name="quantity" min="1"
                            class="w-20 border rounded px-2 py-1 text-center" />

                        <span id="modal-stock" class="text-sm text-gray-500"></span>
                    </div>

                    <button id="modal-cart-button" type="submit"
                        class="mt-4 w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                        Add to cart
                    </button>
                </form>
            </div>
        </div>

        {{-- JS --}}
        <script>
            const products = @json($products->keyBy('id'));

            function openModal(id) {
                const product = products[id];

                document.getElementById('modal-image').src = product.image_url;
                document.getElementById('modal-name').innerText = product.name;
                document.getElementById('modal-price').innerText =
                    '$' + Number(product.price).toLocaleString();
                document.getElementById('modal-description').innerText =
                    product.description ?? '';

                // Quantity
                const quantityInput = document.getElementById('modal-quantity');
                quantityInput.max = product.quantity;
                quantityInput.value = 1;

                document.getElementById('modal-stock').innerText =
                    `/ stocks ${product.quantity}`;

                // Cart form
                document.getElementById('modal-cart-form').action =
                    `/cart/add/${product.id}`;

                // Favorite
                @auth
                document.getElementById('modal-favorite-form').action =
                    `/products/${product.id}/favorite`;
                document.getElementById('modal-favorite').innerText =
                    product.is_favorite ? '★' : '☆';
            @endauth

            document.getElementById('product-modal').classList.remove('hidden');
            document.getElementById('product-modal').classList.add('flex');
            }

            function closeModal() {
                document.getElementById('product-modal').classList.add('hidden');
                document.getElementById('product-modal').classList.remove('flex');
            }
        </script>
        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $products->links() }}
        </div>

    </div>
   
</x-app-layout>
>>>>>>> 77caff5170112a97dd06ec865221415c7d322d35
