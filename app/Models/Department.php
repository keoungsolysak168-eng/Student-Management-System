<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = [
        'dept_name',
        'manager_id',
        'location_id',
    ];

    // One department can have many students.
    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'dept_id');
    }
}
