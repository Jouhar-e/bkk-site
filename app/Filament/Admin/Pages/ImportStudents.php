<?php

namespace App\Filament\Admin\Pages;

use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use App\Imports\StudentImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Icons\Heroicon;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImportStudents extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Import Siswa';
    protected static null|BackedEnum|string $navigationIcon = Heroicon::ArrowUpTray;
    protected string $view = 'filament.admin.pages.import-students';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Siswa';
    protected static ?int $navigationSort = 22;

    public array $data = [];

    public static function canAccess(): bool
    {
        return Auth::user()?->role === 'super_admin';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                FileUpload::make('file')
                    ->label('File Excel Siswa')
                    ->required()
                    ->multiple(false)
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                    ->disk(null) // Tidak menyimpan ke disk
                    ->directory(null) // Tidak ada directory
                    ->preserveFilenames()
                    ->helperText('Pastikan file sesuai dengan template yang disediakan.'),
                Placeholder::make('spacer')
                    ->content('')
                    ->hiddenLabel()
                    ->columnSpanFull()
                    ->extraAttributes(['class' => 'h-6']),
            ]);
    }

    public function downloadTemplate(): BinaryFileResponse
    {
        $path = storage_path('app/private/templates/template_import_siswa.xlsx');
        return response()->download($path, 'template_import_siswa.xlsx');
    }

    public function import(): void
    {
        $state = $this->form->getState();

        if (empty($state['file'])) {
            Notification::make()
                ->title('File tidak ditemukan')
                ->danger()
                ->send();
            return;
        }

        // FileUpload dengan disk null akan mengembalikan TemporaryUploadedFile
        $uploadedFile = $state['file'];

        if (is_array($uploadedFile)) {
            $uploadedFile = $uploadedFile[0];
        }

        try {
            // **PROSES FILE TANPA MENYIMPAN**

            // Method 1: Import langsung dari uploaded file
            Excel::import(new StudentImport, $uploadedFile);

            // Method 2: Jika perlu path, gunakan temporary path
            // $tempPath = $uploadedFile->getRealPath();
            // Excel::import(new StudentImport, $tempPath);

            // **FILE AKAN OTOMATIS DIHAPUS OLEH LARAVEL/LIVEWIRE**
            // Setelah request selesai, temporary file akan dibersihkan

            Notification::make()
                ->title('Import Berhasil')
                ->success()
                ->body('Data siswa telah diimport')
                ->send();

            // Reset form
            $this->data = [];
        } catch (\Exception $e) {
            Notification::make()
                ->title('Import Gagal')
                ->danger()
                ->body($e->getMessage())
                ->send();
        }
    }
}
