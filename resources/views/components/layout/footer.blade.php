<!-- resources/views/components/footer.blade.php -->
@props(['profile'])

<footer class="bg-blue-950 text-white mt-auto">
    <!-- Main Footer -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Logo dan Deskripsi -->
            <div class="md:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    @if ($profile->logo)
                        <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo {{ $profile->name_bkk }}"
                            class="h-12 w-12 bg-white rounded-lg p-1 object-contain">
                    @else
                        <div class="bg-blue-500 text-white p-2 rounded-lg">
                            <i class="fas fa-school text-xl"></i>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-xl font-bold">{{ $profile->name_bkk ?? 'BKK SMK Negeri 3 Tuban' }}</h3>
                        <p class="text-blue-200 text-sm">{{ $profile->school_name ?? 'SMK Negeri 3 Kerek' }}</p>
                    </div>
                </div>
                <p class="text-blue-100 text-sm mb-4 max-w-2xl">
                    {!! Str::limit(
                        $profile->description ??
                            'Bursa Kerja Khusus (BKK) merupakan lembaga yang dibentuk oleh sekolah untuk memfasilitasi penyaluran dan penempatan tenaga kerja lulusan SMK di dunia usaha dan dunia industri.',
                        300,
                    ) !!}
                    <a href="{{ route('profile') }}"
                        class="inline-flex items-center text-blue-400 hover:text-blue-300 font-semibold transition-colors duration-200 group ml-1">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-1 text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </p>
                <br>
                <div class="flex space-x-3">
                    @if ($profile->facebook_url)
                        <a href="{{ $profile->facebook_url }}" target="_blank"
                            class="bg-blue-800 hover:bg-blue-700 p-3 rounded transition duration-300 transform hover:scale-110 w-10 h-10 flex items-center justify-center">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                    @endif

                    @if ($profile->instagram_url)
                        <a href="{{ $profile->instagram_url }}" target="_blank"
                            class="bg-blue-800 hover:bg-blue-700 p-3 rounded transition duration-300 transform hover:scale-110 w-10 h-10 flex items-center justify-center">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                    @endif

                    @if ($profile->linkedin_url)
                        <a href="{{ $profile->linkedin_url }}" target="_blank"
                            class="bg-blue-800 hover:bg-blue-700 p-3 rounded transition duration-300 transform hover:scale-110 w-10 h-10 flex items-center justify-center">
                            <i class="fab fa-linkedin-in text-sm"></i>
                        </a>
                    @endif

                    @if ($profile->youtube_url)
                        <a href="{{ $profile->youtube_url }}" target="_blank"
                            class="bg-blue-800 hover:bg-blue-700 p-3 rounded transition duration-300 transform hover:scale-110 w-10 h-10 flex items-center justify-center">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                    @endif

                    <!-- Optional TikTok or other social media -->
                    @if (!$profile->facebook_url && !$profile->instagram_url && !$profile->linkedin_url && !$profile->youtube_url)
                        <!-- Placeholder social icons if no URLs provided -->
                        <div class="flex space-x-3">
                            <div class="bg-blue-800 p-3 rounded w-10 h-10 flex items-center justify-center opacity-50">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </div>
                            <div class="bg-blue-800 p-3 rounded w-10 h-10 flex items-center justify-center opacity-50">
                                <i class="fab fa-instagram text-sm"></i>
                            </div>
                            <div class="bg-blue-800 p-3 rounded w-10 h-10 flex items-center justify-center opacity-50">
                                <i class="fab fa-youtube text-sm"></i>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="text-lg font-bold mb-4 text-blue-300">Kontak Kami</h4>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mr-3 mt-1 text-blue-400 flex-shrink-0"></i>
                        <span class="text-blue-100 text-sm">
                            {{ $profile->address ?? 'Alamat' }}
                        </span>
                    </li>
                    @if ($profile->city)
                        <li class="flex items-start pl-7">
                            <span class="text-blue-100 text-sm">
                                {{ $profile->city }}
                            </span>
                        </li>
                    @endif

                    <li class="flex items-center">
                        <i class="fas fa-phone mr-3 text-blue-400 flex-shrink-0"></i>
                        <span class="text-blue-100 text-sm">{{ $profile->phone ?? '(021) 12345678' }}</span>
                    </li>

                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-blue-400 flex-shrink-0"></i>
                        <span class="text-blue-100 text-sm break-all">{{ $profile->email ?? 'Email' }}</span>
                    </li>

                    <li class="flex items-center">
                        <i class="fas fa-clock mr-3 text-blue-400 flex-shrink-0"></i>
                        <span class="text-blue-100 text-sm">{{ $profile->office_hours ?? 'Jam Operasional' }}</span>
                    </li>

                    <li class="flex items-center">
                        <i class="fas fa-globe mr-3 text-blue-400 flex-shrink-0"></i>
                        <span class="text-blue-100 text-sm break-all">
                            @if ($profile->website)
                                <a href="{{ $profile->website }}" target="_blank"
                                    class="hover:text-blue-300 transition">
                                    {{ $profile->website }}
                                </a>
                            @else
                                website sekolah
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="border-t border-blue-800">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-blue-200 text-sm mb-2 md:mb-0 text-center md:text-left">
                    &copy; {{ date('Y') }} {{ $profile->school_name ?? 'Nama Sekolah' }}. Semua hak
                    dilindungi undang-undang.
                </div>
                <div class="flex flex-wrap justify-center md:justify-start space-x-4 text-blue-200 text-sm">
                    <a href="#" class="hover:text-white transition duration-300">Kebijakan Privasi</a>
                    <span class="hidden md:inline">•</span>
                    <a href="#" class="hover:text-white transition duration-300">Syarat & Ketentuan</a>
                    <span class="hidden md:inline">•</span>
                    <a href="#" class="hover:text-white transition duration-300">Peta Situs</a>
                </div>
            </div>
        </div>
    </div>
</footer>
