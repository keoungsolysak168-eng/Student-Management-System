<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Department
        </h2>
    </x-slot>

<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">

            <form action="{{ route('departments.update', $department) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="dept_name" class="block mb-2">
                        Department Name
                    </label>

                    <input
                        type="text"
                        id="dept_name"
                        name="dept_name"
                        value="{{ old('dept_name', $department->dept_name) }}"
                        class="w-full border-gray-300 rounded"
                        required
                    >

                    @error('dept_name')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="manager_id" class="block mb-2">
                        Manager ID
                    </label>

                    <input
                        type="number"
                        id="manager_id"
                        name="manager_id"
                        value="{{ old('manager_id', $department->manager_id) }}"
                        class="w-full border-gray-300 rounded"
                    >
                </div>

                <div class="mb-4">
                    <label for="location_id" class="block mb-2">
                        Location ID
                    </label>

                    <input
                        type="number"
                        id="location_id"
                        name="location_id"
                        value="{{ old('location_id', $department->location_id) }}"
                        class="w-full border-gray-300 rounded"
                    >
                </div>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 rounded">
                    Update Department
                </button>

                <a href="{{ route('departments.index') }}"
                   class="ml-3 text-gray-600">
                    Cancel
                </a>
            </form>

        </div>
    </div>
</div>

</x-app-layout>
