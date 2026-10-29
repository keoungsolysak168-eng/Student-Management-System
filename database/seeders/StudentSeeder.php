<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'student_name' => 'Sok Dara',
                'gender' => 'Male',
                'dob' => '2003-05-10',
                'enrollment' => 'STU001',
                'enrollment_date' => '2025-01-15',
                'description' => 'First sample student',
                'dept_id' => 1,
            ],
            [
                'student_name' => 'Chan Sopheak',
                'gender' => 'Female',
                'dob' => '2004-03-20',
                'enrollment' => 'STU002',
                'enrollment_date' => '2025-01-15',
                'description' => 'Second sample student',
                'dept_id' => 2,
            ],
            [
                'student_name' => 'Kim Sreymom',
                'gender' => 'Female',
                'dob' => '2003-08-12',
                'enrollment' => 'STU003',
                'enrollment_date' => '2025-02-01',
                'description' => 'Third sample student',
                'dept_id' => 3,
            ],
            [
                'student_name' => 'Lim Vicheka',
                'gender' => 'Male',
                'dob' => '2002-11-25',
                'enrollment' => 'STU004',
                'enrollment_date' => '2025-02-05',
                'description' => 'Fourth sample student',
                'dept_id' => 1,
            ],
            [
                'student_name' => 'Sokunthea Chea',
                'gender' => 'Female',
                'dob' => '2004-01-18',
                'enrollment' => 'STU005',
                'enrollment_date' => '2025-02-10',
                'description' => 'Fifth sample student',
                'dept_id' => 4,
            ],
        ];

        foreach ($students as $student) {
            Student::firstOrCreate(
                ['enrollment' => $student['enrollment']],
                $student
            );
        }
    }
}
