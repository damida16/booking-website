@extends('layouts.app')
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">
                    Look what you have made today!
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    @if (auth()->user()->hasRole('admin'))
                                        Total Bookings
                                    @else
                                        Your Bookings
                                    @endif
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $totalBookings }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Cloud Product
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $totalCloud }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Security Product
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $totalSecurity }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 mt-2">
                        <h5 class="mb-3">Recent Bookings</h5>
                        <div class="card card-list d-block">
                            <div class="card-body py-2 px-4 font-weight-bold">
                                <div class="row">
                                    <div class="col-md-2">Booking Code</div>
                                    <div class="col-md-2">Sales</div>
                                    <div class="col-md-2">Customer</div>
                                    <div class="col-md-3">Booking Date</div>
                                    <div class="col-md-2">Status</div>
                                    <div class="col-md-1 d-none d-md-block"></div>
                                </div>
                            </div>
                        </div>
                        @foreach ($bookings as $booking)
                            <a class="card card-list d-block" href="{{ route('dashboard.booking.show', $booking->id) }}">
                                <div class="card-body py-2 px-4">
                                    <div class="row">
                                        <div class="col-md-2">{{ $booking->booking_code }}</div>
                                        <div class="col-md-2">{{ $booking->sales }}</div>
                                        <div class="col-md-2">{{ $booking->customer }}</div>
                                        <div class="col-md-3">
                                            {{ $booking->start_book->translatedFormat('j M y') }} -
                                            {{ $booking->end_book->translatedFormat('j M y') }}
                                        </div>
                                        <div class="col-md-2">{{ $booking->status }}</div>
                                        <div class="col-md-1 d-none d-md-block">
                                            <img src="/images/dashboard-arrow-right.svg" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
