<x-layout.app :profile="$profile" :categories="$categories">

    <main class="flex-grow">
        @php
            $categoryStyle = [
                'lowongan-kerja' => [
                    'bg' => 'bg-green-100 text-green-800',
                    'icon' => 'fa-briefcase',
                    'color' => 'text-green-600',
                    'border' => 'border-green-200',
                ],
                'info-kuliah' => [
                    'bg' => 'bg-blue-100 text-blue-800',
                    'icon' => 'fa-graduation-cap',
                    'color' => 'text-blue-600',
                    'border' => 'border-blue-200',
                ],
                'seminar-workshop' => [
                    'bg' => 'bg-purple-100 text-purple-800',
                    'icon' => 'fa-chalkboard-teacher',
                    'color' => 'text-purple-600',
                    'border' => 'border-purple-200',
                ],
                'tips-karir' => [
                    'bg' => 'bg-yellow-100 text-yellow-800',
                    'icon' => 'fa-lightbulb',
                    'color' => 'text-yellow-600',
                    'border' => 'border-yellow-200',
                ],
            ];
        @endphp

        {{-- HERO SLIDER --}}
        @if ($heroArticles->isNotEmpty())
            <x-layout.slider :articles="$heroArticles" />
        @endif

        {{-- ARTICLES SECTION --}}

        <div class="max-w-6xl mx-auto px-4 py-6 md:py-8 lg:py-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">

                <!-- Articles Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md md:shadow-lg border border-gray-100 p-4 md:p-6 lg:p-8">

                        <!-- Section Header -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 md:mb-8">
                            <div class="mb-4 sm:mb-0">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-900">
                                    Berita Seputar BKK
                                </h2>
                                <div class="w-12 md:w-16 h-1 bg-blue-600 rounded-full mt-2"></div>
                            </div>

                            <a href="{{ route('articles.index') }}"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm md:text-base group transition">
                                Lihat Semua
                                <i
                                    class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>

                        <!-- Articles List -->
                        <div class="space-y-4 md:space-y-6">
                            @forelse ($articles as $article)
                                @php
                                    $slug = $article->category->slug;
                                    $style = $categoryStyle[$slug] ?? [
                                        'bg' => 'bg-gray-100 text-gray-800',
                                        'icon' => 'fa-file',
                                        'color' => 'text-gray-600',
                                        'border' => 'border-gray-200',
                                    ];
                                @endphp

                                <article
                                    class="bg-white rounded-lg border {{ $style['border'] }} p-4 md:p-6 
                                             hover:shadow-lg transition-all duration-300 hover:-translate-y-1">

                                    <!-- Category & Time -->
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3 md:mb-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $style['bg'] }} self-start">
                                            <i class="fas {{ $style['icon'] }} mr-1.5 text-xs"></i>
                                            {{ $article->category->name }}
                                        </span>
                                        <span class="text-xs text-gray-500 whitespace-nowrap">
                                            {{ $article->published_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h3
                                        class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 
                                                hover:text-blue-700 transition-colors duration-200 line-clamp-2">
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h3>

                                    <!-- Meta Info -->
                                    <div
                                        class="flex flex-wrap items-center text-xs md:text-sm text-gray-600 gap-3 md:gap-4 mb-3 md:mb-4">
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-1.5 {{ $style['color'] }} text-xs"></i>
                                            {{ $article->admin->name ?? 'Admin BKK' }}
                                        </span>
                                        <div class="flex items-center gap-4 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <i class="fas fa-clock mr-2 {{ $style['color'] }}"></i>
                                                {{ $article->published_at->format('d M Y') }}
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-eye mr-2 {{ $style['color'] }}"></i>
                                                {{ $article->views()->count() }} kali dilihat
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Excerpt -->
                                    <p
                                        class="text-gray-700 text-sm md:text-base mb-4 md:mb-5 leading-relaxed line-clamp-3">
                                        {{ Str::limit(strip_tags($article->content), 180) }}
                                    </p>

                                    <!-- Read More -->
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                        class="inline-flex items-center {{ $style['color'] }} hover:opacity-80 font-semibold text-sm md:text-base group transition">
                                        Baca Selengkapnya
                                        <i
                                            class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1.5 transition-transform duration-200"></i>
                                    </a>
                                </article>
                            @empty
                                <div class="text-center py-10">
                                    <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500">Belum ada berita tersedia</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- View All Button -->
                        <div class="text-center mt-8 md:mt-10">
                            <a href="{{ route('articles.index') }}"
                                class="inline-flex items-center px-5 py-3 md:px-6 md:py-3 bg-gradient-to-r from-blue-600 to-blue-700 
                                      text-white font-semibold text-sm md:text-base rounded-lg 
                                      hover:from-blue-700 hover:to-blue-800 
                                      transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Lihat Semua Berita
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-5 md:space-y-6">

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-xl shadow-md md:shadow-lg border border-gray-100 p-4 md:p-6">
                        <h3
                            class="text-lg md:text-xl font-bold text-gray-900 mb-4 md:mb-6 pb-2 md:pb-3 border-b-2 border-blue-600">
                            Info Cepat
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-3 md:gap-4">
                            <!-- Alumni -->
                            <div
                                class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 text-center 
                                        border border-blue-200 hover:shadow-md transition-all duration-300">
                                <div class="text-2xl md:text-3xl font-bold text-blue-600 mb-1 md:mb-2">
                                    {{ $stats['alumni_count'] ?? 0 }}
                                </div>
                                <div class="text-gray-700 font-medium text-sm md:text-base">Alumni</div>
                                <div class="text-xs text-gray-500 mt-1">SMK N 3 Tuban</div>
                            </div>

                            <!-- Companies -->
                            <div
                                class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 text-center 
                                        border border-green-200 hover:shadow-md transition-all duration-300">
                                <div class="text-2xl md:text-3xl font-bold text-green-600 mb-1 md:mb-2">
                                    {{ $stats['partner_companies'] ?? 0 }}
                                </div>
                                <div class="text-gray-700 font-medium text-sm md:text-base">Perusahaan Mitra</div>
                                <div class="text-xs text-gray-500 mt-1">DU/DI Partner</div>
                            </div>

                            <!-- Active Jobs -->
                            <div
                                class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-4 text-center 
                                        border border-yellow-200 hover:shadow-md transition-all duration-300">
                                <div class="text-2xl md:text-3xl font-bold text-yellow-600 mb-1 md:mb-2">
                                    {{ $stats['active_jobs'] ?? 0 }}
                                </div>
                                <div class="text-gray-700 font-medium text-sm md:text-base">Lowongan Aktif</div>
                                <div class="text-xs text-gray-500 mt-1">Tersedia</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="bg-white rounded-xl shadow-md md:shadow-lg border border-gray-100 p-4 md:p-6">
                        <h3
                            class="text-lg md:text-xl font-bold text-gray-900 mb-4 md:mb-5 pb-2 md:pb-3 border-b-2 border-blue-600">
                            Akses Cepat
                        </h3>

                        <div class="space-y-2 md:space-y-3">
                            @foreach ($categories as $category)
                                @php
                                    $style = $categoryStyle[$category->slug] ?? [
                                        'icon' => 'fa-file',
                                        'color' => 'text-blue-600',
                                    ];
                                @endphp

                                <a href="{{ route('articles.category', $category->slug) }}"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-700 
                                          group transition-all duration-200 hover:translate-x-1">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 rounded-md {{ $style['bg'] ?? 'bg-blue-100' }} mr-3">
                                        <i class="fas {{ $style['icon'] }} text-sm {{ $style['color'] }}"></i>
                                    </div>
                                    <span class="font-medium text-sm md:text-base">{{ $category->name }}</span>
                                    <i
                                        class="fas fa-chevron-right ml-auto text-xs text-gray-400 
                                       group-hover:text-blue-600 group-hover:translate-x-1 transition-all"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-gradient-to-br from-blue-900 to-blue-950 rounded-xl shadow-lg p-5 md:p-6 text-white">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Butuh Bantuan?</h3>
                        <p class="text-blue-200 text-sm mb-4 md:mb-5 leading-relaxed">
                            Hubungi tim BKK untuk informasi lebih lanjut mengenai lowongan kerja, pelatihan, atau
                            konsultasi karir.
                        </p>
                        <a href="{{ route('profile') }}#kontak"
                            class="inline-flex items-center px-4 py-2 bg-white text-blue-900 font-semibold text-sm rounded-lg 
                                  hover:bg-blue-100 transition">
                            <i class="fas fa-phone-alt mr-2"></i>
                            Kontak Kami
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </main>

</x-layout.app>
