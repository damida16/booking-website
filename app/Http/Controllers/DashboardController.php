<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        if (auth()->user()->hasRole('admin')) {

            // Fetch all bookings for admin
            $bookings = Booking::with(['user', 'products'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            $totalBookings = Booking::count();
            $totalCloud = Product::where('kategori', 'Cloud')->count();
            $totalSecurity = Product::where('kategori', 'Security')->count();
        } else {
            // Fetch only the bookings of the current user
            $bookings = Booking::with(['products'])
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();

            $totalBookings = Booking::where('user_id', auth()->id())->count();
            $totalCloud = Product::where('kategori', 'Cloud')->count();
            $totalSecurity = Product::where('kategori', 'Security')->count();
        }

        return view('dashboard.index', compact('bookings', 'totalBookings', 'totalCloud', 'totalSecurity'));
    }
}
