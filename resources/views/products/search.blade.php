@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Search Results
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">

        @if ($products->count() > 0)
            <h3 class="text-lg mt-6 mb-6">
                Search results for "{{ $keyword }}":
                {{ $products->count() }}
                {{ Str::plural('item', $products->count()) }}
            </h3>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <a href="{{ route('products.show', $product) }}"
                        class="bg-white rounded-lg shadow hover:shadow-md transition p-2 text-center w-full">

                        <img src="{{ Storage::url($product->image) }}"
                            class="mx-auto w-20 h-20 object-cover rounded-md mb-2">

                        <p class="text-xs font-semibold truncate">
                            {{ $product->name }}
                        </p>

                        <p class="text-pink-600 font-bold text-xs mt-1">
                            ¥{{ number_format($product->price) }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">
                No matching products found
            </p>
        @endif

    </div>

</x-app-layout>
