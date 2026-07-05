{{-- resources/views/admin/orders/show.blade.php --}}
<x-app-layout>
    <h1 class="text-xl font-bold mb-6">
        Order Details（#{{ $order->id }}） 
    </h1>

    <div class="mb-6">
        <p>Purchaser：{{ $order->user->name }}</p>
        <p>Order Date：{{ $order->created_at->format('Y-m-d H:i') }}</p>
        <p>Total：¥{{ number_format($order->total_price) }}</p>
    </div>

    <table class="w-full border text-sm">
        <thead>
        <tr class="bg-gray-100">
            <th class="p-2">Product Name</th>
            <th class="p-2">Price</th>
            <th class="p-2">Quantity</th>
            <th class="p-2">Subtotal</th>
        </tr>
        </thead>

        <tbody>
        @foreach($order->orderItems as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->product->name }}</td>
                <td class="p-2">${{ number_format($item->price) }}</td>
                <td class="p-2">{{ $item->quantity }}</td>
                <td class="p-2">
                    ${{ number_format($item->price * $item->quantity) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
