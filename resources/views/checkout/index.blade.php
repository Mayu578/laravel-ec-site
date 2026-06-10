<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-pink-600 tracking-wide">Checkout</h2>
    </x-slot>

    @if (session('error'))
        <div class="text-red-500">
            {{ session('error') }}
        </div>
    @endif

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($cartItems->isEmpty())
            <p class="text-gray-500">There are no items in your cart.。</p>
            <a href="{{ route('products.index') }}"
                class="mt-4 inline-block bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">
                Go back to Product List Page
            </a>
        @else
            <div class="bg-white p-6 rounded-lg shadow-md">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Product Name</th>
                            <th class="py-2">Image</th>
                            <th class="py-2">Price</th>
                            <th class="py-2">Quantity</th>
                            <th class="py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->product->name }}</td>
                                <td>
                                    @if ($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-gray-100 flex items-center justify-center text-gray-400 text-sm rounded">
                                            No Image
                                        </div>
                                    @endif
                                </td>
                                <td class="py-2">${{ number_format($item->product->price) }}</td>
                                <td class="py-2">{{ $item->quantity }}</td>
                                <td class="py-2">${{ number_format($item->product->price * $item->quantity) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 text-right font-semibold text-lg">
                    Total: ${{ number_format($total) }}
                </div>

                <form method="POST" action="{{ route('checkout.confirm') }}" class="mt-6 text-right">
                    @csrf
                    <button type="submit" class="bg-green-500  px-6 py-2 rounded hover:bg-green-600">
                        Purchase Confirmed
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
