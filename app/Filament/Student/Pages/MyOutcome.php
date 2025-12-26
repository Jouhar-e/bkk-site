<?php

namespace App\Filament\Student\Pages;

use BackedEnum;
use App\Models\Company;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use App\Models\StudentOutcome;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;

class MyOutcome extends Page
{
    protected static ?string $navigationLabel = 'Status Lulusan';
    protected static ?string $label = 'Status Lulusan';
    protected static ?string $title = 'Status Lulusan';
    protected static ?string $pluralLabel = 'Status Lulusan';
    protected static null|BackedEnum|string $navigationIcon = Heroicon::DocumentCheck;

    protected string $view = 'filament.student.pages.my-outcome';

    public ?StudentOutcome $outcome = null;

    public array $data = [];

    /* =========================
     *  LOAD DATA SISWA
     * ========================= */
    public function mount(): void
    {
        $student = Auth::guard('student')->user();

        $this->outcome = StudentOutcome::query()
            ->where('student_id', $student->id)
            ->first();

        if ($this->outcome) {
            $this->form->fill($this->outcome->toArray());
        }
    }

    /* =========================
     *  FORM
     * ========================= */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([

                /* STATUS */
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'bekerja' => 'Bekerja',
                        'kuliah' => 'Kuliah',
                        'wirausaha' => 'Wirausaha',
                        'belum_tersalurkan' => 'Belum Tersalurkan',
                    ])
                    ->required()
                    ->live(),

                /* PERUSAHAAN TERDAFTAR */
                Select::make('company_id')
                    ->label('Perusahaan (jika terdaftar)')
                    ->options(
                        \App\Models\Company::query()
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->visible(fn($get) => $get('status') === 'bekerja'),

                /* PERUSAHAAN MANUAL */
                TextInput::make('institution_name')
                    ->label('Nama Perusahaan (jika belum terdaftar)')
                    ->placeholder('Contoh: PT Maju Jaya Sejahtera')
                    ->visible(fn($get) => $get('status') === 'bekerja'),


                /* KAMPUS – KHUSUS KULIAH */
                TextInput::make('institution_name')
                    ->label('Nama Kampus / Institusi')
                    ->visible(fn($get) => $get('status') === 'kuliah'),

                /* POSISI / PROGRAM */
                TextInput::make('position_or_program')
                    ->label('Posisi / Program'),

                /* KOTA */
                TextInput::make('city')
                    ->label('Kota'),

                /* TANGGAL MULAI */
                DatePicker::make('start_date')
                    ->label('Tanggal Mulai'),

                Placeholder::make('spacer')
                    ->content('')
                    ->hiddenLabel()
                    ->columnSpanFull()
                    ->extraAttributes(['class' => 'h-6']),
            ]);
    }

    /* =========================
     *  SIMPAN DATA
     * ========================= */
    public function save(): void
    {
        $student = Auth::guard('student')->user();

        StudentOutcome::updateOrCreate(
            ['student_id' => $student->id],
            [
                ...$this->data,

                'student_id' => $student->id,

                // 🔥 SETIAP UPDATE → VERIFIKASI ULANG
                'is_verified' => false,

                'updated_by_type' => 'student',
                'updated_by_id' => $student->id,
                'last_updated_at' => now(),
            ]
        );

        Notification::make()
            ->title('Data berhasil disimpan')
            ->body('Data akan diverifikasi ulang oleh admin.')
            ->success()
            ->send();

        // Refresh state
        $this->outcome = StudentOutcome::where('student_id', $student->id)->first();
    }
}
