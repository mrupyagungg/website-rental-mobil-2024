<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;
use Midtrans\Config;
use Midtrans\Snap;

class CarController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY'); // Set server key dari file .env
        Config::$isProduction = false; // Ubah ke true jika di production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index(Request $request)
    {
        // Inisialisasi query
        $cars = Car::where('status', 1);

        // Filter jika ada parameter
        if ($request->has('category_id') && $request->category_id) {
            $cars->where('id', $request->category_id);
        }

        if ($request->has('id') && $request->id) {
            $cars->where('id', $request->id);
        }

        if ($request->has('penumpang') && $request->penumpang) {
            $cars->where('penumpang', '>=', $request->penumpang);
        }

        // Eksekusi query untuk mendapatkan mobil yang difilter
        $cars = $cars->get();

        // Return ke view dengan data mobil yang difilter
        return view('frontend.car.index', compact('cars'));
    }

    public function show(Car $car)
    {
        return view('frontend.car.show', compact('car'));
    }

    public function store(BookingRequest $request)
    {
        // Membuat booking
        $booking = Booking::create($request->validated());

        // Buat transaksi Midtrans setelah booking dibuat
        $transactionDetails = [
            'order_id' => 'BOOKING-' . $booking->id . '-' . time(),
            'gross_amount' => $booking->jumlah, // Sesuaikan dengan harga booking
        ];

        $customerDetails = [
            'first_name' => $request->nama_lengkap,
            'last_name' => '',
            'email' => $request->email,
            'phone' => $request->nomer_wa,
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);
            $booking->snap_token = $snapToken;
            $booking->save();

            // Redirect ke halaman checkout
            return redirect()->route('frontend.checkout', ['booking_id' => $booking->id]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuat pembayaran: ' . $e->getMessage(),
                'alert-type' => 'danger'
            ]);
        }
    }

    public function paymentPage($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        return view('frontend.payment.midtrans', compact('booking'));
    }
}
