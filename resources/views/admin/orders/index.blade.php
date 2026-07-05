<<<<<<< HEAD
{{-- resources/views/admin/orders/index.blade.php --}}
<x-app-layout>
    <h1 class="text-xl font-bold mb-6">Order management</h1>

    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Order ID</th>
                <th class="p-2">Purchaser</th>
                <th class="p-2">Total Price</th>
                <th class="p-2">Order Date</th>
                <th class="p-2">Details</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($orders as $order)
                <tr class="bg-gray-100 font-semibold">
                    <td class="p-2">#{{ $order->id }}</td>
                    <td class="p-2">{{ $order->user->name }}</td>
                    <td class="p-2">¥{{ number_format($order->total_price) }}</td>
                    <td class="p-2">{{ $order->created_at->format('Y-m-d') }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-500 hover:underline">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">
                        No orders found.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</x-app-layout>
=======
{{-- resources/views/admin/orders/index.blade.php --}}
<x-app-layout>
    <h1 class="text-xl font-bold mb-6">Order management</h1>

    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Order ID</th>
                <th class="p-2">Purchaser</th>
                <th class="p-2">Total Price</th>
                <th class="p-2">Order Date</th>
                <th class="p-2">Details</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($orders as $order)
                <tr class="bg-gray-100 font-semibold">
                    <td class="p-2">#{{ $order->id }}</td>
                    <td class="p-2">{{ $order->user->name }}</td>
                    <td class="p-2">¥{{ number_format($order->total_price) }}</td>
                    <td class="p-2">{{ $order->created_at->format('Y-m-d') }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-500 hover:underline">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">
                        No orders found.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</x-app-layout>
>>>>>>> 77caff5170112a97dd06ec865221415c7d322d35
