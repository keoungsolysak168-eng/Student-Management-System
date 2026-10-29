<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Department Management
        </h2>
    </x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white p-6 shadow-sm sm:rounded-lg">

            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-red-600">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('departments.create') }}"
                class="inline-block rounded bg-blue-600 px-4 py-2 font-semibold hover:bg-blue-700">
                    Add Department
                </a>
            </div>

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-3">ID</th>
                        <th class="border p-3">Department Name</th>
                        <th class="border p-3">Total Students</th>
                        <th class="border p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($departments as $department)
                        <tr>
                            <td class="border p-3">
                                {{ $department->id }}
                            </td>

                            <td class="border p-3">
                                {{ $department->dept_name }}
                            </td>

                            <td class="border p-3">
                                {{ $department->students_count }}
                            </td>

                            <td class="border p-3">
                                <a href="{{ route('departments.edit', $department) }}"
                                   class="text-blue-600 mr-3">
                                    Edit
                                </a>

                                <form action="{{ route('departments.destroy', $department) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600"
                                            onclick="return confirm('Delete this department?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border p-3 text-center">
                                No departments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $departments->links() }}
            </div>

        </div>
    </div>
</div>

</x-app-layout>
