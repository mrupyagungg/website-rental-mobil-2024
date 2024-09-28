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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key untuk pengguna
            $table->string('nama_lengkap');
            $table->string('alamat_lengkap');
            $table->string('nomer_wa', 15); // Nomor WA dengan panjang maksimum 15 karakter
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->decimal('jumlah', 15, 2); // Harga sewa dengan desimal
            $table->decimal('total_pembayaran', 15, 2)->nullable(); // Total pembayaran
            $table->string('status')->default('pending'); // Status booking
            $table->text('catatan')->nullable(); // Catatan tambahan
            $table->timestamp('waktu_booking')->useCurrent(); // Waktu saat booking dibuat
            $table->timestamps();

            // Menambahkan indeks untuk tanggal
            $table->index(['tanggal_awal', 'tanggal_akhir']);
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
