<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Section List
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.sections.create') }}" class="bg-purple-500 px-3 py-1 rounded mb-4 inline-block">
            New Addition
        </a>

        <ul class="space-y-2">
            @foreach ($sections as $section)
                <li class="border rounded p-2 flex justify-between items-center">
                    <span>{{ $section->name }} ({{ $section->category }})</span>
                    <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 px-2 py-1 rounded">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Section List
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.sections.create') }}" class="bg-purple-500 px-3 py-1 rounded mb-4 inline-block">
            New Addition
        </a>

        <ul class="space-y-2">
            @foreach ($sections as $section)
                <li class="border rounded p-2 flex justify-between items-center">
                    <span>{{ $section->name }} ({{ $section->category }})</span>
                    <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 px-2 py-1 rounded">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
>>>>>>> 77caff5170112a97dd06ec865221415c7d322d35
