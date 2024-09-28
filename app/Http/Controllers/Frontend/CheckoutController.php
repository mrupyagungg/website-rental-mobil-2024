<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;

class CheckoutController extends Controller
{
    public function show($booking_id)
    {
        // Ambil data booking berdasarkan ID
        $booking = Booking::findOrFail($booking_id);

        $car = Car::findOrFail($booking->car_id);

        // Tampilkan halaman checkout dengan data booking
        return view('frontend.checkout', compact('booking', 'car'));
    }
}
