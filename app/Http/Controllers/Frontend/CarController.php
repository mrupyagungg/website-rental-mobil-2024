<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;

class CarController extends Controller
{
    public function index(Request $request)
    {
        // Initialize the query
        $cars = Car::where('status', 1);

        // Apply filters if present
        if ($request->has('category_id') && $request->category_id) {
            $cars->where('id', $request->category_id);
        }

        // Apply filter if 'id' parameter is used
        if ($request->has('id') && $request->id) {
            $cars->where('id', $request->id);
        }

        if ($request->has('penumpang') && $request->penumpang) {
            $cars->where('penumpang', '>=', $request->penumpang);
        }

        // Execute the query to get the filtered cars
        $cars = $cars->get();

        // Return the view with the filtered cars
        return view('frontend.car.index', compact('cars'));
    }

    public function show(Car $car)
    {
        return view('frontend.car.show', compact('car'));
    }

    public function store(BookingRequest $request)
    {
        Booking::create($request->validated());

        return redirect()->back()->with([
            'message' => 'kami akan menghubungi anda secepatnya !',
            'alert-type' => 'success'
        ]);
    }
}
