<?php

namespace App\Filament\Admin\Resources\StudentOutcomes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class StudentOutcomeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 🔑 PILIH ALUMNI SAJA
                Select::make('student_id')
                    ->label('Alumni')
                    ->relationship(
                        name: 'student',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) =>
                        $query->where('level', 'alumni')
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->getOptionLabelFromRecordUsing(
                        fn($record) => "{$record->nisn} - {$record->name}"
                    ),

                // STATUS
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'bekerja' => 'Bekerja',
                        'kuliah' => 'Kuliah',
                        'wirausaha' => 'Wirausaha',
                        'belum_tersalurkan' => 'Belum Tersalurkan',
                    ])
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // reset semua field instansi
                        if ($state !== 'bekerja') {
                            $set('company_id', null);
                        }

                        if (! in_array($state, ['bekerja', 'kuliah', 'wirausaha'])) {
                            $set('institution_name', null);
                        }
                    }),

                // ===== BEKERJA - OPSI PARTNER =====
                Select::make('company_id')
                    ->label('Perusahaan Partner BKK')
                    ->relationship('company', 'name')
                    ->searchable()
                    ->preload()
                    ->visible(fn($get) => $get('status') === 'bekerja')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('institution_name', null);
                        }
                    }),

                // ===== BEKERJA (NON PARTNER) / KULIAH / WIRAUSAHA =====
                TextInput::make('institution_name')
                    ->label('Nama Perusahaan / Kampus / Usaha (Manual)')
                    ->visible(
                        fn($get) =>
                        in_array($get('status'), ['bekerja', 'kuliah', 'wirausaha'])
                    )
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('company_id', null);
                        }
                    })
                    ->required(
                        fn($get) =>
                        in_array($get('status'), ['kuliah', 'wirausaha'])
                            || ($get('status') === 'bekerja' && empty($get('company_id')))
                    ),

                TextInput::make('position_or_program')
                    ->label('Posisi / Program'),

                TextInput::make('city')
                    ->label('Kota'),

                DatePicker::make('start_date')
                    ->label('Tanggal Mulai'),

                Toggle::make('is_verified')
                    ->label('Terverifikasi'),
            ]);
    }
}
