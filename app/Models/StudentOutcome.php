<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentOutcome extends Model
{
    protected $fillable = [
        'student_id',
        'status',
        'company_id',
        'institution_name',
        'position_or_program',
        'city',
        'start_date',
        'is_verified',
        'updated_by_type',
        'updated_by_id',
        'last_updated_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'start_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
