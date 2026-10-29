<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    // Display all departments.
    public function index()
    {
        $departments = Department::withCount('students')
            ->latest()
            ->paginate(10);

        return view('departments.index', compact('departments'));
    }

    // Show the form to create a department.
    public function create()
    {
        return view('departments.create');
    }

    // Save a new department.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dept_name' => [
                'required',
                'string',
                'max:255',
                'unique:departments,dept_name',
            ],
            'manager_id' => ['nullable', 'integer'],
            'location_id' => ['nullable', 'integer'],
        ]);

        Department::create($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    // Display a department.
    public function show(Department $department)
    {
        $department->load('students');

        return view('departments.show', compact('department'));
    }

    // Show the edit form.
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // Update department information.
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'dept_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'dept_name')
                    ->ignore($department->id),
            ],
            'manager_id' => ['nullable', 'integer'],
            'location_id' => ['nullable', 'integer'],
        ]);

        $department->update($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    // Delete a department if it has no students.
    public function destroy(Department $department)
    {
        if ($department->students()->exists()) {
            return redirect()
                ->route('departments.index')
                ->with('error', 'Cannot delete a department that has students.');
        }

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
