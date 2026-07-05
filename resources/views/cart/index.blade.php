<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Your Cart</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        @if ($cartItems->count() > 0)
            <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach ($cartItems as $item)
                            @php
                                $total = $item->product->price * $item->quantity;
                                $grandTotal += $total;
                            @endphp
                            <tr class="border-b">
                                <td class="py-2 flex items-center gap-2">
                                    @if ($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            class="w-12 h-12 object-cover rounded">
                                    @endif
                                    <span>{{ $item->product->name }}</span>
                                </td>
                                <td>${{ number_format($item->product->price) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $item) }}" method="POST"
                                        class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')

                                        <input type="number" name="quantity" min="1"
                                            max="{{ $item->product->quantity }}" value="{{ $item->quantity }}"
                                            onchange="this.form.submit()" class="w-16 border rounded px-2">

                                        <button class="bg-blue-500 text-white px-2 py-1 rounded">
                                            Update
                                        </button>
                                    </form>



                                </td>
                                <td>${{ number_format($total) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="bg-red-500 px-2 rounded">
                                            <i class="fa-solid fa-trash-can-arrow-up"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right font-bold">Grand Total:</td>
                            <td class="font-bold">${{ number_format($grandTotal) }}</td>
                            <td class="text-right">
                                <a href="{{ route('checkout') }}"
                                    class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">
                                    Checkout
                                </a>
                            </td>
                        </tr>


                    </tbody>
                </table>

                {{-- <div class="mt-4 text-right">
                    <a href="{{ route('checkout') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Checkout
                    </a>
                </div> --}}
            </div>
        @else
            <p class="text-center text-gray-500">Your cart is empty.</p>
        @endif
    </div>
</x-app-layout>
