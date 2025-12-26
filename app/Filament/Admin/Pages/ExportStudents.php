<?php

namespace App\Filament\Admin\Pages;

use UnitEnum;
use BackedEnum;
use App\Exports\StudentsExport;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class ExportStudents extends Page
{
    protected static ?string $navigationLabel = 'Export Data Siswa & Alumni';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Siswa';
    protected static ?int $navigationSort = 22;
    protected static null|BackedEnum|string $navigationIcon = 'heroicon-o-arrow-down-tray';
    
    protected string $view = 'filament.admin.pages.export-students';

    /**
     * Cek akses untuk halaman ini
     * Hanya super_admin dan staff yang bisa akses
     */
    public static function canAccess(): bool
    {
        $user = Auth::user();
        return in_array($user?->role, ['super_admin', 'staff']);
    }

    /**
     * Export data ke format Excel (.xlsx)
     */
    public function exportExcel()
    {
        try {
            $filename = 'data-siswa-alumni-' . date('Y-m-d-His') . '.xlsx';

            // Download file Excel
            return Excel::download(new StudentsExport(), $filename);
        } catch (\Exception $e) {
            // Notifikasi error jika gagal
            Notification::make()
                ->title('Export Gagal')
                ->danger()
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->send();

            return back();
        }
    }

    /**
     * Export data ke format CSV
     */
    public function exportCsv()
    {
        try {
            $filename = 'data-siswa-alumni-' . date('Y-m-d-His') . '.csv';

            // Download file CSV
            return Excel::download(new StudentsExport(), $filename, \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv',
            ]);
        } catch (\Exception $e) {
            Notification::make()
                ->title('Export Gagal')
                ->danger()
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->send();

            return back();
        }
    }

    /**
     * Tampilkan statistik data sebelum export
     */
    public function showStats()
    {
        // Hitung statistik
        $totalStudents = \App\Models\Student::where('level', 'siswa')->count();
        $totalAlumni = \App\Models\Student::where('level', 'alumni')->count();
        $totalWithOutcome = \App\Models\Student::whereHas('outcome')->count();
        $totalVerified = \App\Models\Student::whereHas('outcome', function ($q) {
            $q->where('is_verified', true);
        })->count();

        // Tampilkan notifikasi dengan statistik
        Notification::make()
            ->title('📊 Statistik Data')
            ->success()
            ->body("
                👨‍🎓 Total Siswa: {$totalStudents} data
                👨‍🎓 Total Alumni: {$totalAlumni} data  
                📝 Status terisi: {$totalWithOutcome} data
                ✅ Terverifikasi: {$totalVerified} data
            ")
            ->send();
    }

    /**
     * Actions di header halaman
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('show_stats')
                ->label('Lihat Statistik')
                ->color('gray')
                ->icon('heroicon-o-chart-bar')
                ->action('showStats'),
        ];
    }
}
