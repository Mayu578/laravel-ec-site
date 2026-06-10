<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Edit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Price</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Stock</label>
                        <input type="number" name="quantity" min="0"
                            value="{{ old('stock', $product->stock ?? 0) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Section</label>
                        <select name="section_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ $product->section_id == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Image</label>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像"
                                class="w-32 h-32 object-cover rounded mb-2">
                        @endif
                        <input type="file" name="image" class="mt-1 block w-full">
                    </div>

                    <button type="submit"
                        class="bg-pink-300  px-5 py-2 rounded-full hover:bg-pink-400 transition-colors">
                        Update
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
