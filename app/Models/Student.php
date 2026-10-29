<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'student_name',
        'gender',
        'dob',
        'enrollment',
        'enrollment_date',
        'description',
        'dept_id',
    ];

    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'enrollment_date' => 'date',
        ];
    }

    // Each student belongs to one department.
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
