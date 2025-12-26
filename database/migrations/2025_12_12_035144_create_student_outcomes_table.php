<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_outcomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->enum('status', ['bekerja', 'kuliah', 'wirausaha', 'belum_tersalurkan'])
                  ->default('belum_tersalurkan');
            $table->foreignId('company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->string('institution_name')->nullable();      // kampus / usaha / perusahaan non-mitra
            $table->string('position_or_program')->nullable();   // jabatan / prodi
            $table->string('city')->nullable();
            $table->date('start_date')->nullable();

            $table->boolean('is_verified')->default(false);      // diverifikasi admin atau belum
            $table->enum('updated_by_type', ['admin', 'student'])->default('student');
            $table->unsignedBigInteger('updated_by_id')->nullable(); // id user/student (tanpa FK karena polymorphic)
            $table->timestamp('last_updated_at')->nullable();

            $table->timestamps();

            $table->index(['status', 'is_verified']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_outcomes');
    }
};
