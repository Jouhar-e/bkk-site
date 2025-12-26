<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BkkProfile;
use App\Models\ArticleView;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'admin'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('articles.index', [
            'profile' => BkkProfile::first(),
            'articles' => $articles,
            'categories' => ArticleCategory::orderBy('name')->get(),
        ]);
    }

    public function show(string $slug)
    {
        $article = Article::with([
            'category:id,name',
            'admin:id,name'
        ])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $ip = request()->ip();
        $today = now()->toDateString();
        $viewCacheKey = "article:viewed:{$article->id}:{$ip}:{$today}";

        if (!Cache::has($viewCacheKey)) {
            ArticleView::create([
                'article_id' => $article->id,
                'viewer_ip' => $ip,
                'viewed_at' => now(),
            ]);

            Cache::put($viewCacheKey, true, 86400);
            Cache::forget("article:views:total:{$article->id}");
            Cache::forget("article:views:daily:{$article->id}:{$today}");
        }

        $totalViews = Cache::remember(
            "article:views:total:{$article->id}",
            300,
            fn() => ArticleView::where('article_id', $article->id)->count()
        );

        $dailyViews = Cache::remember(
            "article:views:daily:{$article->id}:{$today}",
            300,
            fn() => ArticleView::where('article_id', $article->id)
                ->whereDate('viewed_at', $today)
                ->count()
        );

        $relatedArticles = Cache::remember(
            "article:related:{$article->category_id}",
            1800,
            fn() => Article::with('category:id,name')
                ->where('status', 'published')
                ->where('category_id', $article->category_id)
                ->where('id', '!=', $article->id)
                ->latest('published_at')
                ->take(4)
                ->get()
        );

        $profile = Cache::remember('bkk_profile_public', 3600, fn() => BkkProfile::first());
        $categories = Cache::remember('article_categories_public', 3600, fn() => ArticleCategory::orderBy('name')->get());

        return view('articles.show', compact(
            'profile',
            'article',
            'relatedArticles',
            'categories',
            'totalViews',
            'dailyViews'
        ));
    }

    public function category(string $slug)
    {
        $category = ArticleCategory::where('slug', $slug)->firstOrFail();

        $articles = Article::with(['category', 'admin'])
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(9);

        return view('articles.category', [
            'profile' => BkkProfile::first(),
            'category' => $category,
            'articles' => $articles,
            'categories' => ArticleCategory::orderBy('name')->get(),
        ]);
    }
}
