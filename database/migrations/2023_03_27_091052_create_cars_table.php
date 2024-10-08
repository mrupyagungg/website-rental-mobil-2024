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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('slug');
            $table->foreignId('type_id');
            $table->decimal('price', 15, 2);
            $table->string('transmisi');
            $table->integer('penumpang');
            $table->integer('unit');
            $table->integer('tahun');
            $table->text('description');
            $table->text('image');
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
