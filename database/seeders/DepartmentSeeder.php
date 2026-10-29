<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['dept_name' => 'Information Technology'],
            ['dept_name' => 'Management Information System'],
            ['dept_name' => 'Accounting'],
            ['dept_name' => 'Marketing'],
            ['dept_name' => 'Finance'],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate($department);
        }
    }
}
