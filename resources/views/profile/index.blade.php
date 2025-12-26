<x-layout.app :profile="$profile" :categories="$categories">

    {{-- Header --}}
    <div class="bg-blue-950 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-2">Profil BKK</h1>
            <p class="text-blue-200 text-sm">
                Informasi resmi Bursa Kerja Khusus {{ $profile->school_name }}
            </p>
        </div>
    </div>

    {{-- Content --}}
    <div class="w-full">
        <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8 py-10">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left: Profile Info --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Tentang BKK --}}
                    <section class="bg-white rounded-xl shadow border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">
                            Tentang BKK
                        </h2>

                        <p class="text-gray-700 leading-relaxed">
                            {{ $profile->description }}
                        </p>
                    </section>

                    {{-- Visi --}}
                    @if ($profile->vision)
                        <section class="bg-white rounded-xl shadow border border-gray-100 p-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">
                                Visi
                            </h2>

                            <p class="text-gray-700 leading-relaxed">
                                {{ $profile->vision }}
                            </p>
                        </section>
                    @endif

                    {{-- Misi --}}
                    @if ($profile->mission)
                        <section class="bg-white rounded-xl shadow border border-gray-100 p-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">
                                Misi
                            </h2>

                            <div class="text-gray-700 leading-relaxed">
                                {!! nl2br(e($profile->mission)) !!}
                            </div>
                        </section>
                    @endif
                </div>

                {{-- Right: Sidebar --}}
                <aside class="space-y-6">

                    {{-- Logo --}}
                    <div class="bg-white rounded-xl shadow border border-gray-100 p-6 text-center">
                        @if ($profile->logo)
                            <img src="{{ asset('storage/' . $profile->logo) }}" alt="{{ $profile->name_bkk }}"
                                class="mx-auto h-28 mb-4 object-contain">
                        @endif

                        <h3 class="font-bold text-gray-900">
                            {{ $profile->name_bkk }}
                        </h3>

                        <p class="text-sm text-gray-600">
                            {{ $profile->school_name }}
                        </p>
                    </div>

                    {{-- Kontak --}}
                    <div class="bg-white rounded-xl shadow border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">
                            Kontak BKK
                        </h3>

                        <ul class="space-y-3 text-sm text-gray-700">

                            @if ($profile->address)
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-map-marker-alt text-blue-600 mt-1"></i>
                                    <span>{{ $profile->address }}, {{ $profile->city }}</span>
                                </li>
                            @endif

                            @if ($profile->phone)
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-phone text-blue-600"></i>
                                    <span>{{ $profile->phone }}</span>
                                </li>
                            @endif

                            @if ($profile->email)
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-envelope text-blue-600"></i>
                                    <span>{{ $profile->email }}</span>
                                </li>
                            @endif

                            @if ($profile->office_hours)
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-clock text-blue-600"></i>
                                    <span>{{ $profile->office_hours }}</span>
                                </li>
                            @endif

                            @if ($profile->website)
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-globe text-blue-600"></i>
                                    <a href="{{ $profile->website }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        {{ $profile->website }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    {{-- Social Media --}}
                    <div class="bg-white rounded-xl shadow border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">
                            Media Sosial
                        </h3>

                        <div class="flex gap-3">
                            @if ($profile->facebook_url)
                                <a href="{{ $profile->facebook_url }}" target="_blank"
                                    class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif

                            @if ($profile->instagram_url)
                                <a href="{{ $profile->instagram_url }}" target="_blank"
                                    class="w-10 h-10 bg-pink-500 text-white rounded-full flex items-center justify-center">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif

                            @if ($profile->linkedin_url)
                                <a href="{{ $profile->linkedin_url }}" target="_blank"
                                    class="w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif

                            @if ($profile->youtube_url)
                                <a href="{{ $profile->youtube_url }}" target="_blank"
                                    class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>

</x-layout.app>
