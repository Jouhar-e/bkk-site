<x-filament-panels::page>
    <div class="max-w-2xl mx-auto">
        {{ $this->form }}

        <div class="mt-6 flex justify-end">
            <x-filament::button wire:click="save" color="primary">
                Simpan Perubahan
            </x-filament::button>
        </div>
    </div>
</x-filament-panels::page>
