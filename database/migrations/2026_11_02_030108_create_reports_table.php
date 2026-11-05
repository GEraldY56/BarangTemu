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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('category');
            $table->enum('type', ['Barang Hilang', 'Barang Temuan']);
            $table->string('location');
            $table->date('report_date');
            $table->time('report_time')->nullable();
            $table->enum('status', ['Belum Ditemukan', 'Sudah Ditemukan', 'Sudah Dikembalikan'])->default('Belum Ditemukan');
            $table->text('description');
            $table->string('reporter_name');
            $table->string('reporter_class');
            $table->string('reporter_contact');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
