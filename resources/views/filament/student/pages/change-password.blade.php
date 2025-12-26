<x-filament::page>
    <div class="max-w-md mx-auto py-8"> <!-- Tambahkan padding vertical -->
        <x-filament::card>

            <form wire:submit.prevent="save" class="space-y-6">
                {{ $this->form }}

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700 mt-6"> <!-- Separator dengan margin -->
                    <div class="flex items-center justify-between">
                        <x-filament::button type="submit" color="primary" icon="heroicon-o-check-circle">
                            Simpan Password Baru
                        </x-filament::button>
                    </div>
                </div>
            </form>
        </x-filament::card>
    </div>
</x-filament::page>
