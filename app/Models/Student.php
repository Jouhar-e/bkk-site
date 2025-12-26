<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'name',
        'email',
        'password',
        'level',
        'major_id',
        'graduation_year',
        'phone',
        'is_active',
        'must_change_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'must_change_password' => 'boolean',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function outcome()
    {
        return $this->hasOne(StudentOutcome::class);
    }

    /**
     * Tentukan panel Filament yang boleh diakses student
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'student'
            && $this->is_active === true;
    }

    public function getAuthIdentifierName(): string
    {
        return 'nisn';
    }
}
