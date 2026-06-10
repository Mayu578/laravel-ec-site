<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            Product List
        </h2>
    </x-slot>

    <div class="py-12 bg-[#f9f5f1]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-md rounded-2xl p-8">

                {{-- ボタン --}}
                <a href="{{ route('admin.products.create') }}"
                    class="inline-block mb-6 bg-[#d8c3b0] hover:bg-[#c4ad97] font-semibold px-5 py-2 rounded-xl shadow-sm transition">
                    Add new product
                </a>

                {{-- 韓国カフェ風テーブル --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-[#f3ece4] text-[#6d5848] text-left">
                                <th class="px-4 py-3 border-b">ID</th>
                                <th class="px-4 py-3 border-b">Product Name</th>
                                <th class="px-4 py-3 border-b">Price</th>
                                <th class="px-4 py-3 border-b">Category</th>
                                <th class="px-4 py-3 border-b">Section</th>
                                <th class="px-4 py-3 border-b">Stock</th>
                                <th class="px-4 py-3 border-b">Image</th>
                                <th class="px-4 py-3 border-b">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr class="hover:bg-[#faf6f2] transition">
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $product->id }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $product->name }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">¥{{ number_format($product->price) }}
                                    </td>

                                    {{-- 大カテゴリー --}}
                                    <td class="px-4 py-3 border-b text-gray-700">
                                        {{ $product->section->category }}
                                    </td>

                                    {{-- セクション --}}
                                    <td class="px-4 py-3 border-b text-gray-700">
                                        {{ $product->section->name }}
                                    </td>

                                    {{-- 在庫 --}}
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $product->quantity }}</td>

                                    {{-- 画像 --}}
                                    <td class="px-4 py-3 border-b">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像"
                                                class="w-20 h-auto rounded-lg shadow-sm">
                                        @else
                                            <span class="text-gray-400">No image</span>
                                        @endif
                                    </td>

                                    {{-- 操作 --}}
                                    <td class="px-4 py-3 border-b">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="inline-block bg-[#f1d6c6] hover:bg-[#e6c5b3] text-[#6d5848] px-3 py-1 rounded-lg text-sm font-semibold shadow-sm transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-[#e9b4a3] hover:bg-[#d9a092] px-3 py-1 rounded-lg text-sm font-semibold shadow-sm transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
