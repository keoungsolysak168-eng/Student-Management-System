<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Management
        </h2>
    </x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-4 rounded bg-green-100 p-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-4 rounded bg-red-100 p-3 text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Add student button --}}
            <div class="mb-6">
                <a href="{{ route('students.create') }}"
                   class="inline-block rounded bg-blue-600 px-4 py-2 font-semibold hover:bg-blue-700">
                    Add Student
                </a>
            </div>

            {{-- Search and filter form --}}
            <form action="{{ route('students.index') }}"
                  method="GET"
                  class="mb-6 flex flex-wrap items-end gap-4">

                <div class="flex-1">
                    <label for="search" class="mb-1 block font-medium">
                        Search Student
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Enter student name or enrollment..."
                        class="w-full rounded border-gray-300"
                    >
                </div>

                <div class="flex-1">
                    <label for="dept_id" class="mb-1 block font-medium">
                        Filter by Department
                    </label>

                    <select
                        id="dept_id"
                        name="dept_id"
                        class="w-full rounded border-gray-300"
                    >
                        <option value="">All Departments</option>

                        @foreach ($departments as $department)
                            <option
                                value="{{ $department->id }}"
                                @selected((string) request('dept_id') === (string) $department->id)
                            >
                                {{ $department->dept_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700">
                    Search / Filter
                </button>

                <a href="{{ route('students.index') }}"
                   class="rounded bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300">
                    Reset
                </a>
            </form>

            {{-- Students table --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-3 text-left">ID</th>
                            <th class="border p-3 text-left">Student Name</th>
                            <th class="border p-3 text-left">Gender</th>
                            <th class="border p-3 text-left">Date of Birth</th>
                            <th class="border p-3 text-left">Enrollment</th>
                            <th class="border p-3 text-left">Department</th>
                            <th class="border p-3 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($students as $student)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-3">
                                    {{ $student->id }}
                                </td>

                                <td class="border p-3">
                                    {{ $student->student_name }}
                                </td>

                                <td class="border p-3">
                                    {{ $student->gender }}
                                </td>

                                <td class="border p-3">
                                    {{ $student->dob->format('Y-m-d') }}
                                </td>

                                <td class="border p-3">
                                    {{ $student->enrollment }}
                                </td>

                                <td class="border p-3">
                                    {{ $student->department->dept_name ?? 'No Department' }}
                                </td>

                                <td class="border p-3 whitespace-nowrap">
                                    <a href="{{ route('students.show', $student) }}"
                                       class="mr-2 text-green-600 hover:underline">
                                        View
                                    </a>

                                    <a href="{{ route('students.edit', $student) }}"
                                       class="mr-2 text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('students.destroy', $student) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this student?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border p-6 text-center text-gray-500">
                                    No students found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $students->links() }}
            </div>

            <p class="mt-4 text-sm text-gray-500">
                Total students displayed on this page: {{ $students->count() }}
            </p>

        </div>
    </div>
</div>

</x-app-layout>
