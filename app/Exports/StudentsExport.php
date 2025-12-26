<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    /**
     * Mengambil semua data siswa dengan relasi
     */
    public function collection()
    {
        // Eager loading untuk optimasi query
        return Student::with(['major', 'outcome', 'outcome.company'])
            ->orderBy('level')
            ->orderBy('major_id')
            ->orderBy('name')
            ->get();
    }

    /**
     * Header untuk kolom Excel
     */
    public function headings(): array
    {
        return [
            'No.',
            'NISN',
            'Nama Lengkap',
            'Email',
            'Level',
            'Jurusan',
            'Tahun Lulus',
            'No. Telepon',
            'Status Akun',
            'Status Kelulusan',
            'Institusi/Perusahaan',
            'Posisi/Program',
            'Kota',
            'Tanggal Mulai',
            'Status Verifikasi',
            'Terakhir Diperbarui',
        ];
    }

    /**
     * Mapping data per baris
     */
    public function map($student): array
    {
        static $rowNumber = 1;

        // Ambil nama institusi/perusahaan
        $institutionName = $student->outcome?->institution_name;

        // Jika institution_name kosong dan ada company_id, ambil dari relasi company
        if (empty($institutionName) && $student->outcome?->company_id) {
            $institutionName = $student->outcome->company?->name ?? '-';
        } elseif (empty($institutionName)) {
            $institutionName = '-';
        }

        return [
            $rowNumber++,
            $student->nisn,
            $student->name,
            $student->email,
            $student->level == 'siswa' ? 'Siswa' : 'Alumni',
            $student->major->name ?? '-',
            $student->graduation_year ?? '-',
            $student->phone ?? '-',
            $student->is_active ? 'Aktif' : 'Nonaktif',

            // Data outcome
            $student->outcome ? $this->getStatusText($student->outcome->status) : 'Belum diisi',
            $institutionName, // Menggunakan variabel yang sudah diolah
            $student->outcome?->position_or_program ?? '-',
            $student->outcome?->city ?? '-',
            $student->outcome?->start_date?->format('d/m/Y') ?? '-',

            // Verifikasi
            $student->outcome?->is_verified ? 'Terverifikasi' : 'Belum Diverifikasi',

            // Timestamp
            $student->updated_at?->format('d/m/Y H:i') ?? '-',
        ];
    }

    /**
     * Konversi status dari database ke teks
     */
    private function getStatusText($status): string
    {
        return match ($status) {
            'bekerja' => 'Bekerja',
            'kuliah' => 'Kuliah',
            'wirausaha' => 'Wirausaha',
            'belum_tersalurkan' => 'Belum Tersalurkan',
            default => ucfirst($status),
        };
    }

    /**
     * Styling untuk file Excel
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Header styling
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4F46E5']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ],

            // Auto filter
            'A1:P1' => [ // Diubah dari 'A1:O1' menjadi 'A1:P1' karena ada 16 kolom
                'autoFilter' => true,
            ],
        ];
    }

    /**
     * Lebar kolom Excel
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,    // No.
            'B' => 15,   // NISN
            'C' => 30,   // Nama Lengkap
            'D' => 25,   // Email
            'E' => 12,   // Level
            'F' => 20,   // Jurusan
            'G' => 15,   // Tahun Lulus
            'H' => 20,   // No. Telepon
            'I' => 12,   // Status Akun
            'J' => 20,   // Status Kelulusan
            'K' => 30,   // Institusi/Perusahaan (diperlebar karena mungkin ada nama perusahaan panjang)
            'L' => 25,   // Posisi/Program
            'M' => 15,   // Kota
            'N' => 15,   // Tanggal Mulai
            'O' => 20,   // Status Verifikasi
            'P' => 20,   // Terakhir Diperbarui
        ];
    }
}
