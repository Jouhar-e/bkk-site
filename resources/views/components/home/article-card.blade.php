@props(['article'])

<article class="bg-white rounded-xl shadow-lg p-8 mb-8">
    <div class="flex items-center gap-4 mb-4">
        <div class="bg-blue-100 text-blue-900 font-bold px-4 py-2 rounded-full text-sm">
            {{ $article->category->slug }}
        </div>
        <span class="text-gray-500 text-sm">
            {{ $article->published_at->diffForHumans() }}
        </span>
    </div>

    <h4 class="text-2xl font-bold mb-3">{{ $article->title }}</h4>
    <p class="text-gray-600 text-sm mb-4">
        {{ $article->admin->name }} • {{ $article->published_at->format('d M Y') }}
    </p>

    <p class="text-gray-700 mb-6 leading-relaxed">
        {{ Str::limit(strip_tags($article->content), 200) }}
    </p>

    <a href="{{ route('articles.show', $article->slug) }}" class="text-blue-600 font-semibold hover:underline">
        Baca Selengkapnya →
    </a>
</article>
