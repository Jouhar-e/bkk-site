@props(['articles'])

@php
    use Illuminate\Support\Str;
@endphp

@if ($articles->isNotEmpty())
    <div class="relative w-full">

        <div class="overflow-hidden h-96 relative">
            <div id="simple-slider-track" class="flex h-full transition-transform duration-500">
                @foreach ($articles as $article)
                    @php
                        // =====================
                        // DATA SESUAI DATABASE
                        // =====================
                        $image = $article->cover_image ? asset('storage/' . ltrim($article->cover_image, '/')) : null;

                        $date = $article->published_at ? $article->published_at->format('d M Y') : '';

                        $categoryName = $article->category?->name ?? 'Umum';
                    @endphp

                    <div class="min-w-full h-full relative flex-shrink-0">

                        {{-- Background --}}
                        <div class="absolute inset-0 bg-cover bg-center pointer-events-none"
                            style="{{ $image ? "background-image:url('$image'); filter:brightness(.55);" : 'background:#1f2937;' }}">
                        </div>

                        {{-- Content --}}
                        <div class="absolute inset-0 flex items-center justify-center text-center px-6">
                            <div class="max-w-3xl text-white">

                                <div class="text-sm text-gray-200 mb-2">
                                    {{ $date }} • {{ $categoryName }}
                                </div>

                                <h2 class="text-2xl md:text-4xl font-bold mb-3 leading-tight">
                                    {{ $article->title }}
                                </h2>

                                <p class="hidden md:block text-sm md:text-base mb-4">
                                    {{ Str::limit(strip_tags($article->content), 140) }}
                                </p>

                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="inline-block bg-white bg-opacity-90 text-gray-900 px-5 py-2 rounded-lg font-medium hover:bg-opacity-100 transition">
                                    Baca selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Controls --}}
        <button id="simple-prev" type="button"
            class="absolute left-4 top-1/2 -translate-y-1/2
           w-11 h-11 flex items-center justify-center
           bg-white/90 hover:bg-white
           text-gray-800 rounded-full shadow-lg
           z-50 transition active:scale-95">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <button id="simple-next" type="button"
            class="absolute right-4 top-1/2 -translate-y-1/2
           w-11 h-11 flex items-center justify-center
           bg-white/90 hover:bg-white
           text-gray-800 rounded-full shadow-lg
           z-50 transition active:scale-95">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

    </div>

    @once
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const track = document.getElementById('simple-slider-track');
                    if (!track) return;

                    const slides = Array.from(track.children);
                    const total = slides.length;
                    if (total <= 1) return;

                    let index = 0;
                    let timer = null;

                    const prevBtn = document.getElementById('simple-prev');
                    const nextBtn = document.getElementById('simple-next');

                    function go(i) {
                        index = (i + total) % total;
                        track.style.transform = `translateX(-${index * 100}%)`;
                    }

                    function startAuto() {
                        stopAuto();
                        timer = setInterval(() => go(index + 1), 5000);
                    }

                    function stopAuto() {
                        if (timer) clearInterval(timer);
                    }

                    prevBtn?.addEventListener('click', () => {
                        stopAuto();
                        go(index - 1);
                        startAuto();
                    });

                    nextBtn?.addEventListener('click', () => {
                        stopAuto();
                        go(index + 1);
                        startAuto();
                    });

                    // pause saat hover
                    [track, prevBtn, nextBtn].forEach(el => {
                        el?.addEventListener('mouseenter', stopAuto);
                        el?.addEventListener('mouseleave', startAuto);
                    });

                    go(0);
                    startAuto();
                });
            </script>
        @endpush
    @endonce
@else
    <div class="text-gray-500 text-sm">
        Belum ada artikel untuk ditampilkan.
    </div>
@endif
