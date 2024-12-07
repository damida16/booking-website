<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cart;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{

    public function submit(Request $request)
    {
        try {

            $validated = $request->validate([
                'sales' => 'required|string|max:255',
                'presales' => 'required|string|max:255',
                'customer' => 'required|string|max:255',
                'start_book' => 'required|date',
                'end_book' => 'required|date|after_or_equal:start_book',
                'notes' => 'nullable|string|max:255',
                // 'products' => 'required|array',
                // 'products.*' => 'exists:products,id',
            ]);

            $carts = Cart::with('product')->where('user_id', auth()->id())->get();

            if ($carts->isEmpty()) {
                return redirect()->back()
                    ->withInput() // Keeps the input data
                    ->withErrors(['cart' => 'Your cart is empty. Please add products before submitting.']);
            }

            // Create the booking record
            $booking = Booking::create([
                'booking_code' => $this->generateBookingCode(),
                'user_id' => auth()->user()->id,
                'sales' => $validated['sales'],
                'presales' => $validated['presales'],
                'customer' => $validated['customer'],
                'start_book' => $validated['start_book'],
                'end_book' => $validated['end_book'],
                'notes' => $validated['notes'],
                'status' => 'Booked',
            ]);

            foreach ($carts as $cart) {
                $product = $cart->product;

                // Attach the product to the booking
                $booking->products()->attach($product->id);

                // Update the product's status to 'not available'
                $product->update(['isAvailable' => false]);
            }

            // Clear the cart for the user
            Cart::where('user_id', auth()->id())->delete();

            // Redirect to a success page or back with a success message
            return redirect()->route('dashboard.booking.show', $booking->id)
                ->with('success', 'Booking created successfully, and products have been reserved.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Failed to create a booking. ' . $e->getMessage()
            ]);
        }
    }

    private function generateBookingCode($length = 8)
    {
        do {
            // Generate a random alphanumeric string
            $code = Str::upper(Str::random($length));
            Str::upper(Str::random($length));
        } while (DB::table('bookings')->where('booking_code', $code)->exists());

        return $code;
    }

    public function index()
    {
        try {
            // Check if the user is an admin
            if (auth()->user()->hasRole('admin')) {

                // Fetch all bookings for admin
                $bookings = Booking::with(['user', 'products'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                // Fetch only the bookings of the current user
                $bookings = Booking::with(['products'])
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            // // Return the view with booking data
            return view('bookings.index', compact('bookings'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Failed to load bookings. ' . $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $booking = Booking::with('products')->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Booked,Picked Up,Completed,Canceled',
        ]);

        // Find the booking by ID
        $booking = Booking::with('products')->find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        // Update the status
        $booking->status = $request->input('status');
        $booking->save();

        // Check if the status is 'Completed' or 'Canceled'
        if (in_array($booking->status, ['Completed', 'Canceled'])) {
            // Set all related products' isAvailable to true
            $booking->products()->update(['isAvailable' => true]);
        } else {
            // Otherwise, set all related products' isAvailable to false
            $booking->products()->update(['isAvailable' => false]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }


    public function pdf(Request $request, $id)
    {
        $booking = Booking::with('products')->findOrFail($id);
        $pdf = PDF::loadView('bookings.pdf', ['booking' => $booking]);

        return $pdf->download('booking_' . $booking->booking_code . '.pdf');
        // return view('bookings.pdf', compact('booking'));
    }

    public function checkBookingCode(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'booking_code' => 'required|string',
            ]);

            // Attempt to find the booking in the database
            $booking = Booking::where('booking_code', $request->booking_code)->first();

            if ($booking) {
                return response()->json([
                    'success' => true,
                    'url' => route('dashboard.booking.show', $booking->id),
                ]);
                // return redirect()->route('dashboard.booking.show', $booking->id);
            }

            return response()->json([
                'success' => false,
                'message' => 'Booking code not found.',
            ]);
        } catch (\Exception $e) {
            // Catch any unexpected exceptions
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500); // Send a 500 internal server error response
        }
    }
}
