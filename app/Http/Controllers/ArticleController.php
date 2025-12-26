<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BkkProfile;
use App\Models\ArticleView;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;

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
        $article = Article::with(['category', 'admin'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // =========================
        // HITUNG VIEW ARTIKEL
        // =========================
        $ip = request()->ip();
        $today = Carbon::today();

        $alreadyViewed = ArticleView::where('article_id', $article->id)
            ->where('viewer_ip', $ip)
            ->whereDate('viewed_at', $today)
            ->exists();

        if (! $alreadyViewed) {
            ArticleView::create([
                'article_id' => $article->id,
                'viewer_ip' => $ip,
                'viewed_at' => now(),
            ]);
        }

        // Artikel terkait
        $relatedArticles = Article::with('category')
            ->where('status', 'published')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('articles.show', [
            'profile' => BkkProfile::first(),
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'categories' => ArticleCategory::orderBy('name')->get(),
        ]);
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
