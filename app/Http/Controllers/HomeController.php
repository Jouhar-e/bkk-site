<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use App\Models\Student;
use App\Models\BkkProfile;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'profile' => BkkProfile::first(),

            // slider / hero
            'heroArticles' => Article::with('category')
                ->withCount([
                    'views as views_count' => function ($q) {
                        $q->where('viewed_at', '>=', now()->subDays(30));
                    }
                ])
                ->where('status', 'published')
                ->orderByDesc('views_count')
                ->orderByDesc('published_at')
                ->take(5)
                ->get(),

            // list berita
            'articles' => Article::with(['category', 'admin'])
                ->where('status', 'published')
                ->latest('published_at')
                ->take(3)
                ->get(),

            // sidebar stats
            'stats' => [
                'alumni_count' => Student::where('level', 'alumni')->count(),
                'partner_companies' => Company::where('is_partner', 1)->count(),
                'active_jobs' => Article::where('status', 'published')
                    ->whereHas('category', fn($q) => $q->where('slug', 'lowongan-kerja'))
                    ->count(),
            ],

            // quick links
            'categories' => ArticleCategory::orderBy('name')->get(),
        ]);
    }
}
