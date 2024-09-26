<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Menggunakan guarded untuk melindungi kolom ID
    protected $guarded = ['id'];

    // Menambahkan durasi sebagai kolom yang selalu muncul
    protected $appends = ['durasi'];

    // Relasi dengan model Car
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Accessor untuk menghitung durasi sewa dalam format hari, jam, menit, dan detik
    public function getDurasiAttribute()
    {
        $tanggalAwal = Carbon::parse($this->attributes['tanggal_awal']);
        $tanggalAkhir = Carbon::parse($this->attributes['tanggal_akhir']);

        // Hitung durasi dalam hari, jam, menit, dan detik
        $days = $tanggalAkhir->diffInDays($tanggalAwal);
        $hours = $tanggalAkhir->diffInHours($tanggalAwal) % 24;
        $minutes = $tanggalAkhir->diffInMinutes($tanggalAwal) % 60;
        $seconds = $tanggalAkhir->diffInSeconds($tanggalAwal) % 60;

        // Format durasi
        return "$days hari $hours jam $minutes menit $seconds detik";
    }

    // Menggunakan event creating untuk menghitung total biaya sewa sebelum disimpan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $tanggalAwal = Carbon::parse($booking->tanggal_awal);
            $tanggalAkhir = Carbon::parse($booking->tanggal_akhir);

            // Hitung durasi dalam jam
            $durasiJam = $tanggalAkhir->diffInHours($tanggalAwal);

            // Ambil harga dari mobil yang dipilih
            $car = $booking->car()->first();

            if ($car) {
                // Jika durasi lebih dari atau sama dengan 24 jam, hitung per hari
                if ($durasiJam >= 24) {
                    $durasiHari = ceil($durasiJam / 24); // Membulatkan durasi ke atas
                    $booking->jumlah = $durasiHari * $car->price;
                } else {
                    // Jika kurang dari 24 jam, hitung harga setengah
                    $booking->jumlah = 0.5 * $car->price;
                }
            }
        });
    }
}
