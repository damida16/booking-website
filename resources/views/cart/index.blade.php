@extends('layouts.home')

@section('content')
    <!-- Page Content -->
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="Cart">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Nama Produk &amp; Model</th>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $item)
                                    <tr>
                                        <td style="width: 25%;">
                                            <img src="{{ Storage::url($item->product->foto) }}" alt=""
                                                class="cart-image" />
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">{{ $item->product->nama }}</div>
                                            <div class="product-subtitle">{{ $item->product->model }}</div>
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">{{ $item->product->serial_number }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="#" class="btn btn-remove-cart">
                                                Remove
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Booking Details</h2>
                    </div>
                </div>

                <!-- Booking Form -->
                <form action="{{ route('booking.submit') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="salesName">Sales Name*:</label>
                        <input type="text" class="form-control" id="salesName" name="sales" value="{{ old('sales') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="presalesName">Presales Name*:</label>
                        <input type="text" class="form-control" id="presalesName" name="presales"
                            value="{{ old('presales') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="customerName">Customer Name*:</label>
                        <input type="text" class="form-control" id="customerName" name="customer"
                            value="{{ old('customer') }}" placeholder="e.g : CIMB Niaga" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fromDate">From*:</label>
                            <input type="date" class="form-control" id="fromDate" name="start_book"
                                value="{{ old('start_book') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="toDate">To*:</label>
                            <input type="date" class="form-control" id="toDate" name="end_book"
                                value="{{ old('end_book') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="additionalInfo">Additional Information:</label>
                        <textarea class="form-control" id="additionalInfo" name="notes"
                            placeholder="Do you need a power cable? If so, how much do you need? Do you need a railkit?" rows="4">{{ old('notes') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        @if ($carts->isEmpty())
                            <button type="submit" class="btn btn-secondary mt-4 px-4 btn-block justify-content-end"
                                disabled>
                                Your cart is empty. Add some products before check out
                            </button>
                        @else
                            <button type="submit" class="btn btn-success mt-4 px-4 btn-block justify-content-end">
                                Checkout Now
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
