<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Section
        </h2>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto">
        @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.sections.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label>Section Name</label>
                <input type="text" name="name" class="border rounded w-full" required>
            </div>

            <div class="mb-2">
                <label>Category</label>
                <select name="category" class="border rounded w-full" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-purple-500  px-3 py-1 rounded mt-2">Add</button>
        </form>
    </div>
</x-app-layout>
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Section
        </h2>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto">
        @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.sections.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label>Section Name</label>
                <input type="text" name="name" class="border rounded w-full" required>
            </div>

            <div class="mb-2">
                <label>Category</label>
                <select name="category" class="border rounded w-full" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-purple-500  px-3 py-1 rounded mt-2">Add</button>
        </form>
    </div>
</x-app-layout>
>>>>>>> 77caff5170112a97dd06ec865221415c7d322d35
