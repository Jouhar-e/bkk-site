<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkkProfile extends Model
{
    use HasFactory;

    protected $table = 'bkk_profile';

    protected $fillable = [
        'name_bkk',
        'school_name',
        'logo',
        'description',
        'vision',
        'mission',
        'address',
        'city',
        'phone',
        'email',
        'office_hours',
        'website',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
    ];
}
