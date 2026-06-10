<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- ここから中身 -->
            <div class="bg-white rounded-xl shadow overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Role</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $user->id }}
                                </td>

                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.users.show', $user) }}"
                                       class="text-blue-600 hover:underline font-medium">
                                        {{ $user->name }}
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($user->is_admin)
                                        <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                            Admin
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded-full">
                                            User
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
