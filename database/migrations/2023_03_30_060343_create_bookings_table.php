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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade'); // Foreign key constraint
            $table->string('nama_lengkap');
            $table->string('alamat_lengkap');
            $table->string('nomer_wa');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('jumlah'); // Kolom untuk harga total sewa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
