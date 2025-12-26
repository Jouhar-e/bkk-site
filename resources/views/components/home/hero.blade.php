@props(['article'])

<section class="relative">
    <img src="{{ 'public/' . $article->cover_image ? asset('public/' . $article->cover_image) : 'https://via.placeholder.com/1920x600' }}"
        class="w-full h-96 object-cover brightness-50">

    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-8 max-w-3xl">
            <p class="text-sm uppercase mb-2">
                {{ $article->published_at->format('d M Y') }} • {{ $article->category->name }}
            </p>
            <h2 class="text-5xl font-bold mb-4">{{ $article->title }}</h2>
            <p class="text-lg mb-8 line-clamp-3">
                {{ Str::limit(strip_tags($article->content), 180) }}
            </p>
            <a href="{{ route('articles.show', $article->slug) }}"
                class="bg-white text-blue-950 px-8 py-3 rounded-full font-bold">
                Baca selengkapnya
            </a>
        </div>
    </div>
</section>
