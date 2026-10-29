<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Student
        </h2>
    </x-slot>

<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">

            @if ($errors->any())
                <div class="mb-4 rounded bg-red-100 p-3 text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('students.update', $student) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="student_name" class="mb-1 block font-medium">
                        Student Name
                    </label>

                    <input
                        type="text"
                        id="student_name"
                        name="student_name"
                        value="{{ old('student_name', $student->student_name) }}"
                        class="w-full rounded border-gray-300"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="gender" class="mb-1 block font-medium">
                        Gender
                    </label>

                    <select id="gender" name="gender"
                            class="w-full rounded border-gray-300" required>
                        <option value="Male" @selected(old('gender', $student->gender) === 'Male')>Male</option>
                        <option value="Female" @selected(old('gender', $student->gender) === 'Female')>Female</option>
                        <option value="Other" @selected(old('gender', $student->gender) === 'Other')>Other</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="dob" class="mb-1 block font-medium">
                        Date of Birth
                    </label>

                    <input
                        type="date"
                        id="dob"
                        name="dob"
                        value="{{ old('dob', $student->dob->format('Y-m-d')) }}"
                        max="{{ date('Y-m-d', strtotime('-1 day')) }}"
                        class="w-full rounded border-gray-300"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="enrollment" class="mb-1 block font-medium">
                        Enrollment Number
                    </label>

                    <input
                        type="text"
                        id="enrollment"
                        name="enrollment"
                        value="{{ old('enrollment', $student->enrollment) }}"
                        class="w-full rounded border-gray-300"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="enrollment_date" class="mb-1 block font-medium">
                        Enrollment Date
                    </label>

                    <input
                        type="date"
                        id="enrollment_date"
                        name="enrollment_date"
                        value="{{ old('enrollment_date', $student->enrollment_date->format('Y-m-d')) }}"
                        class="w-full rounded border-gray-300"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="dept_id" class="mb-1 block font-medium">
                        Department
                    </label>

                    <select id="dept_id" name="dept_id"
                            class="w-full rounded border-gray-300" required>
                        @foreach ($departments as $department)
                            <option
                                value="{{ $department->id }}"
                                @selected((string) old('dept_id', $student->dept_id) === (string) $department->id)
                            >
                                {{ $department->dept_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="description" class="mb-1 block font-medium">
                        Description
                    </label>

                    <textarea id="description" name="description" rows="3"
                              class="w-full rounded border-gray-300">{{ old('description', $student->description) }}</textarea>
                </div>

                <button type="submit"
                        class="rounded bg-blue-600 px-4 py-2 font-semibold hover:bg-blue-700">
                    Update Student
                </button>

                <a href="{{ route('students.index') }}"
                   class="ml-3 text-gray-600 hover:underline">
                    Cancel
                </a>
            </form>

        </div>
    </div>
</div>

</x-app-layout>
