<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Display the list of bookings
    public function show()
    {
        $bookings = Booking::all();
        return view('mechanic.booking.show', compact('bookings'));
    }

    // Show the form to create a new booking
    public function create()
    {
        return view('mechanic.booking.create');
    }

    // Store a new booking
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
        ]);

        $booking = Booking::create($request->all());

        // Redirect to the specific booking's page after creation
        return redirect()->route('mechanic.booking.show', $booking->id)
                         ->with('success', 'Booking created successfully.');
    }



    // Edit a booking
    public function edit(Booking $booking)
    {
        $booking = Booking::findOrFail($id);
        return view('mechanic.booking.edit', compact('booking'));
    }

    // Update an existing booking
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
        ]);

        $booking->update($request->all());

        return redirect()->route('mechanic.booking.show')->with('success', 'Product updated successfully.');

    }

    // Delete a booking
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('mechanic.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
