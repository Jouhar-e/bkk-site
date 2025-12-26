<x-filament-panels::page>
    <div class="max-w-3xl mx-auto">

        {{-- STATUS --}}
        <div
            class="flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <span class="text-sm text-gray-600 dark:text-gray-400">
                Status verifikasi
            </span>

            @if (!$outcome)
                <x-filament::badge color="gray" size="sm">
                    Belum diisi
                </x-filament::badge>
            @elseif ($outcome->is_verified)
                <x-filament::badge color="success" size="sm">
                    Terverifikasi
                </x-filament::badge>
            @else
                <x-filament::badge color="warning" size="sm">
                    Menunggu verifikasi
                </x-filament::badge>
            @endif
        </div>

        {{-- TAMBAH JARAK DI SINI --}}
        <br>

        {{-- FORM --}}
        <x-filament::section>
            <x-slot name="heading">
                Status Lulusan
            </x-slot>

            <x-slot name="description">
                Anda dapat memperbarui data kapan saja.
                Setiap perubahan akan memerlukan verifikasi ulang oleh admin.
            </x-slot>

            {{ $this->form }}

            {{-- SAVE BUTTON — SELALU ADA --}}
            <div class="mt-6 flex justify-end">
                <x-filament::button wire:click="save" size="sm" color="primary">
                    Simpan
                </x-filament::button>
            </div>
        </x-filament::section>

    </div>
</x-filament-panels::page>
