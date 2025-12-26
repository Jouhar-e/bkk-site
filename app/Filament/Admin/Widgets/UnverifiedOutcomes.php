<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Models\StudentOutcome;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;

class UnverifiedOutcomes extends TableWidget
{
    protected static ?string $heading = 'Outcome Belum Diverifikasi';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return in_array(Auth::user()?->role, ['super_admin', 'staff'], true);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder =>
                StudentOutcome::query()
                    ->where('is_verified', false)
                    ->latest('updated_at')
            )

            ->columns([
                TextColumn::make('student.nisn')
                    ->label('NISN')
                    ->searchable(),

                TextColumn::make('student.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'bekerja',
                        'info' => 'kuliah',
                        'warning' => 'wirausaha',
                        'gray' => 'belum_tersalurkan',
                    ])
                    ->formatStateUsing(fn(string $state) => ucfirst(str_replace('_', ' ', $state))),

                TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->since()
                    ->sortable(),
            ])

            ->recordActions([
                Action::make('verifikasi')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->url(
                        fn(StudentOutcome $record) =>
                        route('filament.admin.resources.student-outcomes.edit', $record)
                    ),
            ])

            ->paginated([5]);
    }
}
