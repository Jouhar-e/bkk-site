<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentTemplateExport;

class GenerateStudentTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:student-template';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate template Excel import siswa';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::store(
            new StudentTemplateExport,
            'templates/template_import_siswa.xlsx'
        );

        $this->info('Template siswa berhasil dibuat');
    }
}
