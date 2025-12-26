<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;
use App\Models\StudentOutcome;
use App\Models\Article;
use App\Models\Company;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Total Siswa', Student::where('level', 'siswa')->count())
                ->icon('heroicon-o-user-group'),

            Stat::make('Total Alumni', Student::where('level', 'alumni')->count())
                ->icon('heroicon-o-academic-cap'),

            Stat::make(
                'Alumni Terverifikasi',
                StudentOutcome::where('is_verified', true)->count()
            )
                ->icon('heroicon-o-check-badge')
                ->color('success'),

            Stat::make(
                'Belum Diverifikasi',
                StudentOutcome::where('is_verified', false)->count()
            )
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make(
                'Artikel Published',
                Article::where('status', 'published')->count()
            )
                ->icon('heroicon-o-newspaper'),

            Stat::make(
                'Perusahaan Partner',
                Company::where('is_partner', true)->count()
            )
                ->icon('heroicon-o-building-office'),

        ];
    }
}
