<x-layout.app :profile="$profile" :categories="$categories">

    @php
        $categoryStyle = [
            'lowongan-kerja' => ['bg' => 'bg-green-100 text-green-800', 'icon' => 'fa-briefcase'],
            'info-kuliah' => ['bg' => 'bg-blue-100 text-blue-800', 'icon' => 'fa-graduation-cap'],
            'seminar-workshop' => ['bg' => 'bg-purple-100 text-purple-800', 'icon' => 'fa-chalkboard-teacher'],
            'tips-karir' => ['bg' => 'bg-yellow-100 text-yellow-800', 'icon' => 'fa-lightbulb'],
        ];

        $slug = $article->category->slug;
        $style = $categoryStyle[$slug] ?? ['bg' => 'bg-gray-100 text-gray-800', 'icon' => 'fa-file'];
    @endphp

    <div class="w-full">
        <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8 py-8">

            <article class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">

                {{-- HEADER --}}
                <div class="p-8 border-b border-gray-200">

                    <div class="flex justify-between items-start mb-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $style['bg'] }}">
                            <i class="fas {{ $style['icon'] }} mr-1 text-xs"></i>
                            {{ $article->category->name }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ $article->published_at->diffForHumans() }}
                        </span>
                    </div>

                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $article->title }}
                    </h1>

                    <div class="flex flex-wrap items-center text-sm text-gray-600 gap-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">
                                    {{ $article->admin->name ?? 'Admin BKK' }}
                                </p>
                                <p class="text-gray-500 text-xs">Penulis</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2 text-blue-600"></i>
                            Dipublikasikan {{ $article->published_at->format('d M Y') }}
                        </div>
                    </div>
                </div>

                {{-- IMAGE --}}
                @if ($article->cover_image)
                    <div class="w-full h-80 lg:h-96 bg-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                {{-- CONTENT --}}
                <div class="p-8">
                    <div class="text-gray-700 leading-relaxed text-lg">
                        <div class="flex flex-col gap-6 [&_p]:mb-0 [&_p]:mt-0">
                            {!! $article->content !!}
                        </div>
                    </div>

                    {{-- SHARE --}}
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-900">
                                Bagikan artikel:
                            </span>

                            <div class="flex space-x-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                    target="_blank"
                                    class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700">
                                    <i class="fab fa-facebook-f text-sm"></i>
                                </a>

                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank"
                                    class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500">
                                    <i class="fab fa-twitter text-sm"></i>
                                </a>

                                <a href="https://wa.me/?text={{ url()->current() }}" target="_blank"
                                    class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700">
                                    <i class="fab fa-whatsapp text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            {{-- RELATED ARTICLES --}}
            @if ($relatedArticles->isNotEmpty())
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        Artikel Terkait
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($relatedArticles as $related)
                            <div
                                class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition group">

                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $style['bg'] }} mb-3">
                                    <i class="fas {{ $style['icon'] }} mr-1 text-xs"></i>
                                    {{ $related->category->name }}
                                </span>

                                <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-blue-700">
                                    <a href="{{ route('articles.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                </h3>

                                <p class="text-sm text-gray-600 mb-3">
                                    {{ $related->published_at->format('d M Y') }}
                                </p>

                                <a href="{{ route('articles.show', $related->slug) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-semibold inline-flex items-center">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

</x-layout.app>
