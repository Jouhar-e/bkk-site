<x-filament::section>
    <x-slot name="heading" class="font-bold text-lg">
        Status Kelulusan Anda
    </x-slot>

    <div class="p-4">
        @if (!$outcome)
            <div class="space-y-3">
                <p class="text-gray-600">
                    Anda belum mengisi status kelulusan.
                </p>

                <x-filament::button tag="a" href="{{ route('filament.student.pages.my-outcome') }}" size="sm"
                    color="primary">
                    Isi Status Kelulusan
                </x-filament::button>
            </div>
        @else
            <div class="space-y-4">
                {{-- STATUS --}}
                <div class="flex items-center justify-between pb-2 border-b border-gray-200">
                    <span class="text-gray-700 font-medium">
                        Status Saat Ini &nbsp; &nbsp; : &nbsp; &nbsp;
                    </span>
                    <x-filament::badge color="{{ $outcome->status === 'bekerja' ? 'success' : 'info' }}" size="sm">
                        {{ ucfirst($outcome->status) }}
                    </x-filament::badge>
                </div>

                {{-- VERIFIKASI --}}
                <div class="flex items-center justify-between pb-2 border-b border-gray-200">
                    <span class="text-gray-700 font-medium">
                        Verifikasi Admin &nbsp;:  &nbsp; &nbsp;
                    </span>
                    @if ($outcome->is_verified)
                        <x-filament::badge color="success" size="sm">
                            Terverifikasi
                        </x-filament::badge>
                    @else
                        <x-filament::badge color="warning" size="sm">
                            Menunggu
                        </x-filament::badge>
                    @endif
                </div>

                <br>
                {{-- ACTION --}}
                <div class="pt-3 flex gap-3">
                    <x-filament::button tag="a" href="{{ route('filament.student.pages.my-outcome') }}"
                        size="sm" color="primary" class="flex-1">
                        Perbarui Status
                    </x-filament::button>

                    <x-filament::button tag="a" href="{{ route('filament.student.pages.my-profile') }}"
                        size="sm" color="gray" class="flex-1">
                        Profil Saya
                    </x-filament::button>
                </div>
            </div>
        @endif
    </div>
</x-filament::section>
