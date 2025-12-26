<x-layout.app :profile="$profile" :categories="$categories">

    @php
        $categoryStyle = [
            'lowongan-kerja' => ['bg' => 'bg-green-100 text-green-800', 'icon' => 'fa-briefcase'],
            'info-kuliah' => ['bg' => 'bg-blue-100 text-blue-800', 'icon' => 'fa-graduation-cap'],
            'seminar-workshop' => ['bg' => 'bg-purple-100 text-purple-800', 'icon' => 'fa-chalkboard-teacher'],
            'tips-karir' => ['bg' => 'bg-yellow-100 text-yellow-800', 'icon' => 'fa-lightbulb'],
        ];
    @endphp

    {{-- Page Header --}}
    <div class="bg-blue-950 text-white py-10">
        <div class="max-w-6xl mx-auto px-4">
            <h1 class="text-3xl font-bold mb-2">Berita & Informasi</h1>
            <p class="text-blue-200 text-sm">
                Informasi terbaru seputar BKK, lowongan kerja, dan pengembangan karier
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8 py-8">

        {{-- Category Filter --}}
        <div class="flex flex-wrap gap-3 mb-8">
            <a href="{{ route('articles.index') }}"
                class="px-4 py-2 rounded-full text-sm font-semibold
               {{ request()->routeIs('articles.index')
                   ? 'bg-blue-600 text-white'
                   : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('articles.category', $category->slug) }}"
                    class="px-4 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        {{-- Article Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($articles as $article)
                @php
                    $slug = $article->category->slug;
                    $style = $categoryStyle[$slug] ?? ['bg' => 'bg-gray-100 text-gray-800', 'icon' => 'fa-file'];
                @endphp

                <article class="bg-white rounded-xl shadow border border-gray-100 hover:shadow-lg transition">

                    {{-- Image --}}
                    @if ($article->cover_image)
                        <div class="h-48 overflow-hidden rounded-t-xl">
                            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endif

                    <div class="p-5">

                        {{-- Category --}}
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $style['bg'] }} mb-3">
                            <i class="fas {{ $style['icon'] }} mr-1 text-xs"></i>
                            {{ $article->category->name }}
                        </span>

                        {{-- Title --}}
                        <h2 class="text-lg font-bold text-gray-900 mb-2 leading-snug hover:text-blue-700">
                            <a href="{{ route('articles.show', $article->slug) }}">
                                {{ $article->title }}
                            </a>
                        </h2>

                        {{-- Meta --}}
                        <div class="text-xs text-gray-500 mb-3">
                            {{ $article->admin->name ?? 'Admin BKK' }} •
                            {{ $article->published_at->format('d M Y') }}
                        </div>

                        {{-- Excerpt --}}
                        <p class="text-sm text-gray-700 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        {{-- Read More --}}
                        <a href="{{ route('articles.show', $article->slug) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-semibold">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center text-gray-500 py-20">
                    Tidak ada artikel tersedia.
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $articles->links() }}
        </div>

    </div>

</x-layout.app>
