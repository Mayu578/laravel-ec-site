<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-pink-600 tracking-wide">Purchase History</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($orders->isEmpty())
            <p class="text-gray-500">No Purchase History</p>
        @else
            <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Product</th>
                            <th class="py-2">Purchase Content</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Purchase Day</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-b align-top">
                                <td class="py-2">Order #{{ $order->id }}</td>

                                <td class="py-2">
                                    @foreach($order->orderItems as $item)
                                        <div class="flex items-center gap-2 mb-2">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                     class="w-20 h-auto rounded-lg shadow-sm">
                                            @endif
                                            <div>
                                                <div class="font-medium">
                                                    {{ $item->product->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    ¥{{ number_format($item->price) }} × {{ $item->quantity }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>

                                <td class="py-2 font-semibold">
                                    ¥{{ number_format($order->total_price) }}
                                </td>

                                <td class="py-2">
                                    {{ $order->created_at->format('Y-m-d H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
