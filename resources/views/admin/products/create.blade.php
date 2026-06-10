<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Product
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Product Name --}}
                    <div class="mb-4">
                        <label class="block font-medium">Product Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border-gray-300 rounded" />
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <label class="block font-medium">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}"
                            class="w-full border-gray-300 rounded" />
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="block font-medium">Description</label>
                        <textarea name="description" class="w-full border-gray-300 rounded">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Quantity --}}
                    <div class="mb-4">
                        <label class="block font-medium">Quantity</label>
                        <input type="number" name="quantity" min="0" value="{{ old('stock', $product->stock ?? 0) }}" class="w-full border-gray-300 rounded">
                        @error('quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Section --}}
                    <div class="mb-4">
                        <label class="block font-medium">Section</label>
                        <select name="section_id" class="w-full border-gray-300 rounded">
                            <option value="">Please select</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div class="mb-4">
                        <label class="block font-medium">Upload image</label>
                        <input type="file" name="image" class="w-full border-gray-300 rounded" />
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="px-4 py-2 bg-blue-600 rounded">
                        Register
                    </button>
                </form>


            </div>

        </div>
    </div>

</x-app-layout>
