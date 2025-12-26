<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sector',
        'city',
        'is_partner',
        'website',
        'contact_person',
        'phone',
    ];

    protected $casts = [
        'is_partner' => 'boolean',
    ];

    public function studentOutcomes()
    {
        return $this->hasMany(StudentOutcome::class);
    }
}
