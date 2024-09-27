<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Menghitung total data mobil, kontak, dan booking
        $totalMobil = DB::table('cars')->count();
        $totalKontak = DB::table('contacts')->count();
        $totalBooking = DB::table('bookings')->count();

        // Menghitung jumlah booking per mobil
        $bookingCountPerCar = DB::table('bookings')
            ->join('cars', 'bookings.car_id', '=', 'cars.id') // Gabungkan dengan tabel cars
            ->select('cars.nama_mobil', DB::raw('count(bookings.id) as total_bookings')) // Hitung jumlah booking per mobil
            ->groupBy('cars.nama_mobil')
            ->pluck('total_bookings', 'cars.nama_mobil'); // Ambil nama mobil dan total booking

        // Passing data ke view
        return view('home', [
            'totalMobil' => $totalMobil,
            'totalKontak' => $totalKontak,
            'totalBooking' => $totalBooking,
            'bookingCountPerCar' => $bookingCountPerCar // Data untuk grafik
        ]);
    }
}
