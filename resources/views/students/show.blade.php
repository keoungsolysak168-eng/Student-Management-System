<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Student Details
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    View and manage student information
                </p>
            </div>

            <a href="{{ route('students.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                ← Back to Students
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- Student Profile Card --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                {{-- Profile Header --}}
                <div class="bg-gradient-to-r from-indigo-600 via-blue-600 to-blue-500 px-6 py-8 sm:px-10">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                        {{-- Student Avatar --}}
                        <div class="flex h-20 w-20 items-center justify-center rounded-2xl border border-white/30 bg-white/20 text-3xl font-bold text-white shadow-lg">
                            {{ strtoupper(substr($student->student_name, 0, 1)) }}
                        </div>

                        {{-- Student Name --}}
                        <div class="flex-1">
                            <p class="text-sm font-medium text-blue-100">
                                STUDENT PROFILE
                            </p>

                            <h1 class="mt-1 text-2xl font-bold text-white sm:text-3xl">
                                {{ $student->student_name }}
                            </h1>

                            <p class="mt-2 text-sm text-blue-100">
                                Student ID: #{{ $student->id }}
                            </p>
                        </div>

                        {{-- Enrollment Status --}}
                        <div>
                            <span class="inline-flex items-center rounded-full border border-white/30 bg-white/20 px-4 py-2 text-sm font-semibold text-white">
                                <span class="mr-2 h-2 w-2 rounded-full bg-green-300"></span>
                                {{ $student->enrollment }}
                            </span>
                        </div>

                    </div>
                </div>

                {{-- Main Information --}}
                <div class="p-6 sm:p-10">

                    {{-- Section Heading --}}
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-lg text-indigo-600">
                            👤
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Personal Information
                            </h2>
                            <p class="text-sm text-gray-500">
                                Basic details about the student
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        {{-- Student ID --}}
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-5 transition hover:border-indigo-200">
                            <p class="text-sm font-medium text-gray-500">
                                Student ID
                            </p>
                            <p class="mt-2 text-lg font-semibold text-gray-900">
                                #{{ $student->id }}
                            </p>
                        </div>

                        {{-- Gender --}}
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-5 transition hover:border-indigo-200">
                            <p class="text-sm font-medium text-gray-500">
                                Gender
                            </p>
                            <p class="mt-2 text-lg font-semibold text-gray-900">
                                {{ $student->gender ?: 'Not specified' }}
                            </p>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-5 transition hover:border-indigo-200">
                            <p class="text-sm font-medium text-gray-500">
                                Date of Birth
                            </p>
                            <p class="mt-2 text-lg font-semibold text-gray-900">
                                {{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d M Y') : 'Not provided' }}
                            </p>
                        </div>

                        {{-- Enrollment --}}
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-5 transition hover:border-indigo-200">
                            <p class="text-sm font-medium text-gray-500">
                                Enrollment Status
                            </p>
                            <p class="mt-2 text-lg font-semibold text-gray-900">
                                {{ $student->enrollment ?: 'Not specified' }}
                            </p>
                        </div>

                    </div>

                    {{-- Academic Information --}}
                    <div class="mb-6 mt-10 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-lg text-blue-600">
                            🎓
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Academic Information
                            </h2>
                            <p class="text-sm text-gray-500">
                                Enrollment and department details
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        {{-- Department --}}
                        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                            <p class="text-sm font-medium text-gray-500">
                                Department
                            </p>

                            <p class="mt-2 text-lg font-semibold text-indigo-600">
                                {{ $student->department->dept_name ?? 'No Department' }}
                            </p>
                        </div>

                        {{-- Enrollment Date --}}
                        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                            <p class="text-sm font-medium text-gray-500">
                                Enrollment Date
                            </p>

                            <p class="mt-2 text-lg font-semibold text-gray-900">
                                {{ $student->enrollment_date ? \Carbon\Carbon::parse($student->enrollment_date)->format('d M Y') : 'Not provided' }}
                            </p>
                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="mb-6 mt-10 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50 text-lg text-purple-600">
                            📝
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Additional Information
                            </h2>
                            <p class="text-sm text-gray-500">
                                Notes and description
                            </p>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-5">
                        <p class="mb-2 text-sm font-medium text-gray-500">
                            Description
                        </p>

                        <p class="whitespace-pre-line leading-7 text-gray-700">
                            {{ $student->description ?: 'No description available for this student.' }}
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-10 flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                        <a href="{{ route('students.index') }}"
                           class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Back to Students
                        </a>

                        <a href="{{ route('students.edit', $student) }}"
                           class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            ✏️ Edit Student
                        </a>

                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <p class="mt-6 text-center text-sm text-gray-400">
                Student Management System
            </p>

        </div>
    </div>

</x-app-layout>
