<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            Export Data Siswa & Alumni
        </x-slot>

        <p class="text-sm text-gray-600 dark:text-gray-400">
            Download data lengkap dalam format Excel atau CSV. Data mencakup semua informasi siswa, alumni, dan status
            kelulusan.
        </p>
        {{-- Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @php
                $studentCount = \App\Models\Student::where('level', 'siswa')->count();
                $alumniCount = \App\Models\Student::where('level', 'alumni')->count();
                $outcomeCount = \App\Models\Student::whereHas('outcome')->count();
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                {{-- Card Total Siswa --}}
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        {{-- w-28 memberikan ruang yang sama untuk semua label agar titik dua sejajar --}}
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400 w-28 shrink-0">Total
                            Siswa</span>
                        <span class="text-gray-500 dark:text-gray-400 mx-2">:</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $studentCount }}</span>
                    </div>
                </div>

                {{-- Card Total Alumni --}}
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400 w-28 shrink-0">Total
                            Alumni</span>
                        <span class="text-gray-500 dark:text-gray-400 mx-2">:</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $alumniCount }}</span>
                    </div>
                </div>

                {{-- Card Status Terisi --}}
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400 w-28 shrink-0">Status
                            Terisi</span>
                        <span class="text-gray-500 dark:text-gray-400 mx-2">:</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $outcomeCount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>



    <x-filament::section>
        <x-slot name="heading">
            Microsoft Excel (.xlsx)
        </x-slot>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            Format Excel dengan styling dan filter otomatis. Direkomendasikan untuk laporan dan analisis data.
        </p>
        <br>
        <x-filament::button color="success" wire:click="exportExcel" icon="heroicon-o-arrow-down-tray">
            Download Excel File
        </x-filament::button>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">
            CSV File (.csv)
        </x-slot>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            Format CSV untuk kompatibilitas dengan berbagai aplikasi dan sistem.
        </p>
        <br>
        <x-filament::button color="primary" wire:click="exportCsv" icon="heroicon-o-arrow-down-tray">
            Download CSV File
        </x-filament::button>
    </x-filament::section>

    {{-- Last Update --}}
    @php
        $latestUpdate = \App\Models\Student::latest('updated_at')->value('updated_at');
    @endphp
    <div class="text-sm text-gray-500 dark:text-gray-400 mt-4">
        Data terakhir diperbarui:
        <span class="font-medium text-gray-700 dark:text-gray-300">
            @if ($latestUpdate)
                {{ \Carbon\Carbon::parse($latestUpdate)->format('d F Y, H:i') }}
            @else
                Belum ada data
            @endif
        </span>
    </div>
</x-filament-panels::page>
