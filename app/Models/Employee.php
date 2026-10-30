<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_number',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'department',
        'position',
        'employment_date',
        'employment_status',
    ];

    protected function casts(): array
    {
        return [
            'employment_date' => 'date',
        ];
    }
}
