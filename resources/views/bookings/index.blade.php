@extends('layouts.app')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Bookings</h2>
                <p class="dashboard-subtitle">Booking History</p>
            </div>

            <div class="dashboard-content">
                <div class="row mb-3">
                    <div class="col-12">
                        <button class="btn btn-success" id="openScanBookingModal">
                            Scan Booking Code
                        </button>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="sell" role="tabpanel" aria-labelledby="sell-tab">
                        <div class="row mt-3">
                            <div class="col-12 mt-2">
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
                                    <a class="card card-list d-block"
                                        href="{{ route('dashboard.booking.show', $booking->id) }}">
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
        </div>


    </div>
@endsection

@section('script')
    <!-- Scan Booking Modal -->
    <div class="modal fade" style="z-index: 1050 !important" id="scanBookingModal" role="dialog"
        aria-labelledby="scanBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanBookingModalLabel">Scan Booking Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="scannerInput" class="form-control"
                        placeholder="Scan or type booking code here..." autofocus>
                    <div class="mt-2 text-danger" id="error-message"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="scanSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Full jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> <!-- Full Bootstrap with Popper.js -->

    <script>
        $(document).ready(function() {

            // Open Modal
            $('#openScanBookingModal').click(function() {
                $('#scanBookingModal').modal('show');
            });

            // Auto Focus
            $('#scanBookingModal').on('shown.bs.modal', function() {
                $('#scannerInput').focus();
            });

            // Submit Scan Booking Code
            $('#scanSubmit').on('click', function() {
                const bookingCode = $('#scannerInput').val().trim();

                if (!bookingCode) {
                    $('#error-message').text('Please input a valid booking code');
                    return;
                }

                $.ajax({
                    url: '{{ route('check.booking.code') }}',
                    method: 'POST',
                    data: {
                        booking_code: bookingCode,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.url; // Redirect on success
                        } else {
                            $('#error-message').text(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        $('#error-message').text('An error occurred. Please try again.');
                    }
                });
            });

            // Handle Modal Close
            $('.btn-secondary').on('click', function() {
                $('#scanBookingModal').modal('hide');
            });

        });
    </script>
@endsection
