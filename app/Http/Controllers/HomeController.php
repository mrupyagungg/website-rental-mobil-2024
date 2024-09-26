<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Menghitung total data mobil dari database SQLite
        $totalMobil = DB::table('cars')->count();
        $totalKontak = DB::table('contacts')->count();
        $totalBooking = DB::table('bookings')->count();

        // Passing data ke view
        return view('home', [
            'totalMobil' => $totalMobil,
            'totalKontak' => $totalKontak,
            'totalBooking' => $totalBooking
        ]);
    }
}
