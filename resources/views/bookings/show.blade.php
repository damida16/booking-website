@extends('layouts.app')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">#{{ $booking->booking_code }}</h2>
                <p class="dashboard-subtitle">
                    Booking Details
                </p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="w-100 mb-3">
                                            {!! DNS1D::getBarcodeHTML($booking->booking_code, 'C128', 2, 100) !!}
                                        </div>
                                        <form id="pdf-form" method="POST"
                                            action="{{ route('dashboard.booking.pdf', $booking->id) }}">
                                            @csrf
                                            <button href="{{ route('dashboard.booking.pdf', $booking->id) }}"
                                                class="btn btn-success">
                                                Download PDF
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Sales Name</div>
                                                <div class="product-subtitle">{{ $booking->sales }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Presales Name</div>
                                                <div class="product-subtitle">
                                                    {{ $booking->presales }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Customer Name
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $booking->customer }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Booking Status</div>
                                                <div class="product-subtitle">
                                                    @if (auth()->user()->hasRole('admin'))
                                                        <form id="status-form" method="POST"
                                                            action="{{ route('dashboard.booking.updateStatus', $booking->id) }}">
                                                            @csrf
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="Booked"
                                                                    {{ $booking->status == 'Booked' ? 'selected' : '' }}>
                                                                    Booked
                                                                </option>
                                                                <option value="Picked Up"
                                                                    {{ $booking->status == 'Picked Up' ? 'selected' : '' }}>
                                                                    Picked Up</option>
                                                                <option value="Completed"
                                                                    {{ $booking->status == 'Completed' ? 'selected' : '' }}>
                                                                    Completed</option>
                                                                <option value="Canceled"
                                                                    {{ $booking->status == 'Canceled' ? 'selected' : '' }}>
                                                                    Canceled</option>
                                                            </select>
                                                            <div id="save-button" class="product-subtitle mt-2"
                                                                style="display: none;">
                                                                <button class="btn btn-success px-4 py-2" type="submit">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @else
                                                        <p
                                                            class="font-weight-semibold 
                                                              @if ($booking->status === 'Booked') text-primary 
                                                              @elseif($booking->status === 'Picked Up') text-warning 
                                                              @elseif($booking->status === 'Completed') text-success 
                                                              @elseif($booking->status === 'Canceled') text-danger @endif">
                                                            {{ $booking->status }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Booking Start</div>
                                                <div class="product-subtitle">
                                                    {{ $booking->start_book->translatedFormat('j M y') }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Booking End</div>
                                                <div class="product-subtitle">
                                                    {{ $booking->end_book->translatedFormat('j M y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <h5 class="mb-4">
                                            Booking Products
                                        </h5>
                                        <div class="row items-center font-weight-bold">
                                            <div class="col-md-1 my-auto">
                                                #
                                            </div>

                                            <div class="col-md-3 my-auto">
                                                Product Name
                                            </div>

                                            <div class="col-md-2 my-auto">
                                                Model
                                            </div>

                                            <div class="col-md-2 my-auto">
                                                Category
                                            </div>

                                            <div class="col-md-3 my-auto">
                                                Serial Number
                                            </div>
                                        </div>
                                        <hr>
                                        @foreach ($booking->products as $product)
                                            <div class="row items-center border-bottom-1">
                                                <div class="col-md-1 my-auto">
                                                    @if ($product->foto)
                                                        <img src="{{ Storage::url($product->foto) }}" alt="Profile Picture"
                                                            class="img-fluid rounded-circle"
                                                            style="max-width: 50px; height: auto;  aspect-ratio: 1 / 1; object-fit:cover;" />
                                                    @else
                                                        <img src="{{ asset('/images/profile-pic.png') }}"
                                                            alt="Default Profile Picture" class="img-fluid rounded-circle"
                                                            style="max-width: 50px; height: auto;" />
                                                    @endif
                                                </div>

                                                <div class="col-md-3 my-auto">
                                                    {{ $product->nama }}
                                                </div>

                                                <div class="col-md-2 my-auto">
                                                    {{ $product->model }}
                                                </div>

                                                <div class="col-md-2 my-auto">
                                                    {{ $product->kategori }}
                                                </div>

                                                <div class="col-md-3 my-auto">
                                                    {{ $product->serial_number }}
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let originalStatus = $('#status').val(); // Save the initial status

            // Detect change in the select dropdown
            $('#status').on('change', function() {
                const currentStatus = $(this).val();

                // Show the Save button only if the status has changed
                if (currentStatus !== originalStatus) {
                    $('#save-button').show();
                } else {
                    $('#save-button').hide();
                }
            });
        });
    </script>
@endsection
