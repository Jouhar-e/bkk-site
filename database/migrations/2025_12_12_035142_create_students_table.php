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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 20)->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password'); // disimpan dalam bentuk hash
            $table->enum('level', ['siswa', 'alumni'])->default('siswa');
            $table->foreignId('major_id')->constrained('majors')->cascadeOnDelete();
            $table->year('graduation_year')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('must_change_password')->default(true); // paksa ganti password setelah login pertama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
