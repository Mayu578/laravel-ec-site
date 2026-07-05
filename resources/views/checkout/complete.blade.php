<x-app-layout>
    {{-- <x-slot name="header">
    </x-slot> --}}

    <div class="min-h-screen flex items-start justify-center bg-pink-50 px-4">
        <div class="bg-white rounded-2xl shadow-lg max-w-md w-full p-6 text-center ">

            <!-- アイコン（サイズ縮小＆中央） -->
            <div class="flex justify-center mb-5">
                <div class="w-11 h-11 rounded-full bg-pink-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <!-- タイトル -->
            <h1 class="text-2xl font-serif text-pink-600 mb-3">
                Thank you for your purchase
            </h1>

            <!-- サブテキスト -->
            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                Please review your order details below.
            </p>

            <!-- 注文情報カード -->
            <div class="bg-pink-50 rounded-xl p-5 text-center mb-7 space-y-1">
                <p class="text-xs text-gray-600">Order Number</p>
                <p class="font-semibold text-gray-800 text-base">#{{ $order->id }}</p>

                <p class="text-xs text-gray-600 mt-4">Total Amount</p>
                <p class="text-sm font-bold text-pink-600">
                    ${{ number_format($order->total_price) }}
                </p>
            </div>

            <!-- ボタン -->
            <div class="space-y-3">
                <a href="{{ route('products.index') }}"
                    class="w-full border-pink-300 text-pink-600 py-3 rounded-xl text-sm font-medium hover:bg-pink-100 transition">
                    ←Continue Shopping
                </a>
            </div>

        </div>
    </div>

    </div>
</x-app-layout>
