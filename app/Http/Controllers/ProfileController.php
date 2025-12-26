<?php

namespace App\Http\Controllers;

use App\Models\BkkProfile;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'profile' => BkkProfile::firstOrFail(),
            'categories' => ArticleCategory::orderBy('name')->get(),
        ]);
    }
}
