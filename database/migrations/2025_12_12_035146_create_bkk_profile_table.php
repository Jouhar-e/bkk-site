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
        Schema::create('bkk_profile', function (Blueprint $table) {
            $table->id();

            // Identitas utama
            $table->string('name_bkk');
            $table->string('school_name');

            // Logo BKK (path file, bukan binary)
            $table->string('logo')->nullable();

            // Informasi umum
            $table->text('description')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();

            // Kontak & lokasi
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('office_hours')->nullable();
            $table->string('website')->nullable();

            // Sosial media
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkk_profile');
    }
};
