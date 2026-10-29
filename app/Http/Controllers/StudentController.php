<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // Display students with search and department filtering.
    public function index(Request $request)
    {
        $query = Student::with('department');

        // Search by student name or enrollment number.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('enrollment', 'like', "%{$search}%");
            });
        }

        // Filter students by department.
        if ($request->filled('dept_id')) {
            $query->where('dept_id', $request->dept_id);
        }

        $students = $query->orderBy('id')->paginate(10)
            ->withQueryString();

        $departments = Department::orderBy('dept_name')->get();

        return view('students.index', compact(
            'students',
            'departments'
        ));
    }

    // Show the create form.
    public function create()
    {
        $departments = Department::orderBy('dept_name')->get();

        return view('students.create', compact('departments'));
    }

    // Save a new student.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'dob' => ['required', 'date', 'before:today'],
            'enrollment' => ['required', 'string', 'max:100', 'unique:students,enrollment'],
            'enrollment_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'dept_id' => ['required', 'exists:departments,id'],
        ]);

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    // Display a single student.
    public function show(Student $student)
    {
        $student->load('department');

        return view('students.show', compact('student'));
    }

    // Show the edit form.
    public function edit(Student $student)
    {
        $departments = Department::orderBy('dept_name')->get();

        return view('students.edit', compact(
            'student',
            'departments'
        ));
    }

    // Update student information.
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'dob' => ['required', 'date', 'before:today'],
            'enrollment' => [
                'required',
                'string',
                'max:100',
                Rule::unique('students', 'enrollment')
                    ->ignore($student->id),
            ],
            'enrollment_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'dept_id' => ['required', 'exists:departments,id'],
        ]);

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    // Delete a student.
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
