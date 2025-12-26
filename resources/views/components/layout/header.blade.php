@props(['profile', 'categories'])

<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-blue-950 shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                @if ($profile->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo {{ $profile->name_bkk }}"
                        class="h-10 w-10 bg-white rounded-md object-contain p-1">
                @else
                    <div class="bg-blue-600 text-white p-2 rounded-md">
                        <i class="fas fa-school"></i>
                    </div>
                @endif
                <div>
                    <h1 class="text-white font-semibold text-lg">{{ $profile->name_bkk ?? 'BKK SMK Negeri 3 Tuban' }}
                    </h1>
                    <p class="text-xs text-blue-300">{{ $profile->school_name ?? 'SMK Negeri 3 Kerek' }}</p>
                </div>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden lg:flex items-center space-x-6 mr-6">
                <!-- Beranda -->
                <a href="{{ route('home') }}"
                    class="px-3 py-2 text-sm font-medium rounded-md transition
                    {{ request()->routeIs('home')
                        ? 'bg-blue-800 text-white cursor-default'
                        : 'text-blue-200 hover:text-white hover:bg-blue-800' }}">
                    <i class="fas fa-home mr-1"></i>Beranda
                </a>

                <!-- Profil -->
                <a href="{{ route('profile') }}"
                    class="px-3 py-2 text-sm font-medium flex items-center rounded-md transition
                        {{ request()->routeIs('profile')
                            ? 'bg-blue-800 text-white cursor-default'
                            : 'text-blue-200 hover:text-white hover:bg-blue-800' }}">
                    <i class="fas fa-user-circle mr-1"></i>Profil
                </a>

                <!-- Info Dropdown -->
                <div class="relative group">
                    <a href="#"
                        class="px-3 py-2 text-sm font-medium flex items-center rounded-md transition
                        {{ request()->routeIs('articles.category*')
                            ? 'bg-blue-800 text-white cursor-default'
                            : 'text-blue-200 hover:text-white hover:bg-blue-800' }}">
                        <i class="fas fa-info-circle mr-1"></i>Info
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </a>

                    <div
                        class="dropdown-menu absolute opacity-0 invisible group-hover:visible group-hover:opacity-100
                               bg-white shadow-lg rounded-md mt-3 py-2 w-48 right-0 border border-blue-100 z-50
                               transition-all duration-200 ease-out translate-y-2 group-hover:translate-y-0">
                        @foreach ($categories as $category)
                            <a href="{{ route('articles.category', $category->slug) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Login Siswa -->
                <a href="{{ route('filament.student.auth.login') }}"
                    class="px-3 py-2 text-sm font-medium flex items-center rounded-md transition text-blue-200 hover:text-white hover:bg-blue-800">
                    <i class="fa-solid fa-right-to-bracket mr-1"></i>Login
                </a>

            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button"
                class="lg:hidden text-blue-200 text-lg p-2 rounded-md hover:bg-blue-800 transition">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-blue-900 border-t border-blue-800 py-2 hidden">
        <div class="container mx-auto px-4 space-y-1">
            <!-- Beranda -->
            <a href="{{ route('home') }}"
                class="flex items-center py-2 px-3 text-sm rounded-md font-medium
                {{ request()->routeIs('home') ? 'bg-blue-800 text-white' : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                <i class="fas fa-home mr-2 text-blue-300"></i>Beranda
            </a>

            <!-- Profil -->
            <a href="{{ route('profile') }}"
                class="flex items-center py-2 px-3 text-sm rounded-md font-medium
                {{ request()->routeIs('profile') ? 'bg-blue-800 text-white' : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                <i class="fas fa-user-circle mr-2 text-blue-300"></i>Profil
            </a>

            <!-- Info Dropdown Mobile -->
            <div class="border-b border-blue-800">
                <button
                    class="flex justify-between items-center w-full py-2 px-3 text-sm font-medium text-blue-200 mobile-dropdown-toggle">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-300"></i>Info
                    </div>
                    <i class="fas fa-chevron-down text-blue-300 text-xs"></i>
                </button>
                <div class="pl-6 mt-1 hidden mobile-dropdown-content space-y-1 pb-2">
                    @foreach ($categories as $category)
                        <a href="{{ route('articles.category', $category->slug) }}"
                            class="block py-1 text-xs text-blue-300 hover:text-white">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <!-- login Siswa -->
            <a href="{{ route('filament.student.auth.login') }}"
                class="flex items-center py-2 px-3 text-sm rounded-md font-medium text-blue-200 hover:bg-blue-800 hover:text-white">
                <i class="fa-solid fa-right-to-bracket mr-2 text-blue-300"></i>Login
            </a>
        </div>
    </div>
</nav>
