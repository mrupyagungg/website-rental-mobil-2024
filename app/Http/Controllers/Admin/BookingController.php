<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('car')->get()->map(function ($booking) {
            $tanggalAwal = Carbon::parse($booking->tanggal_awal);
            $tanggalAkhir = Carbon::parse($booking->tanggal_akhir);

            // Hitung durasi dalam hari, jam, menit, dan detik
            $days = $tanggalAkhir->diffInDays($tanggalAwal);
            $hours = $tanggalAkhir->diffInHours($tanggalAwal) % 24;
            $minutes = $tanggalAkhir->diffInMinutes($tanggalAwal) % 60;
            $seconds = $tanggalAkhir->diffInSeconds($tanggalAwal) % 60;

            // Format durasi
            $durasi = "$days hari $hours jam $minutes menit $seconds detik";

            // Tambahkan variabel $durasi ke setiap objek booking
            $booking->durasi = $durasi;

            return $booking;
        });

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Form untuk membuat booking baru (implementasi jika dibutuhkan)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'nama_lengkap' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string|max:255',
            'nomer_wa' => 'required|string|max:15',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        // Ambil data mobil berdasarkan car_id
        $car = Car::findOrFail($request->car_id);

        // Menghitung durasi sewa
        $tanggalAwal = Carbon::parse($request->tanggal_awal);
        $tanggalAkhir = Carbon::parse($request->tanggal_akhir);
        $durasi = $tanggalAkhir->diffInDays($tanggalAwal) + 1; // +1 agar menghitung hari mulai dan akhir

        // Menghitung total harga sewa
        $jumlah = $car->price * $durasi;

        // Simpan data booking
        Booking::create([
            'car_id' => $car->id,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat_lengkap' => $request->alamat_lengkap,
            'nomer_wa' => $request->nomer_wa,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'jumlah' => $jumlah, // Total harga sewa
        ]);

        return redirect()->back()->with('message', 'Booking berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // Detail dari booking tertentu (implementasi jika dibutuhkan)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // Form untuk mengedit booking (implementasi jika dibutuhkan)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // Logika update booking (implementasi jika dibutuhkan)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->back()->with([
            'message' => 'Berhasil dihapus!',
            'alert-type' => 'danger',
        ]);
    }
}
