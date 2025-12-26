<x-filament-panels::page>

    <x-filament::section>
        <x-slot name="heading">
            Import Data Siswa
        </x-slot>

        <p class="text-sm text-gray-600">
            Gunakan template resmi dari sistem.
            Password bersifat sementara dan siswa akan dipaksa mengganti password saat login.
        </p>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">
            Template Excel
        </x-slot>

        <x-filament::button color="primary" wire:click="downloadTemplate" icon="heroicon-o-arrow-down-tray">
            Download Template Import Siswa
        </x-filament::button>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">
            Upload File Excel
        </x-slot>

        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button color="success" wire:click="import" icon="heroicon-o-arrow-up-tray">
                Import Data
            </x-filament::button>
        </div>
    </x-filament::section>

</x-filament-panels::page>
    