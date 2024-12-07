@extends('layouts.home')

@section('content')
    <!-- Page Content -->
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Product Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-gallery" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img src="{{ Storage::url($product->foto) }}" alt="" style="max-height:300px" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt=""
                                        style="max-height: 300px;" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->nama }}</h1>
                            <div class="model">{{ $product->model }}</div>
                            <div class="serial_number">{{ $product->serial_number }}</div>
                        </div>
                        <div class="col-lg-2" data-aos="zoom-in">
                            @if ($product->isAvailable)
                                <!-- Render the button if product is available -->
                                <form action="{{ route('addtocart') }}" method="post">
                                    @csrf <!-- CSRF token for security -->

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <button type="submit"
                                        class="btn btn-success nav-link px-4 text-white btn-block mb-3">Add
                                        to Cart</button>
                                </form>
                            @else
                                <!-- Render a note if the product isn't available -->
                                @php
                                    // Get the active booking for this product, if any
                                    $activeBooking = $product
                                        ->bookings()
                                        ->whereIn('status', ['Booked', 'Picked Up'])
                                        ->first();
                                @endphp
                                <div class="text-center">
                                    <button class="btn btn-danger mb-2" disabled>Not Available</button>
                                    @if ($activeBooking)
                                        <p>Booked with Code: <a
                                                href="{{ route('dashboard.booking.show', $activeBooking->id) }}">{{ $activeBooking->booking_code }}</a>
                                        </p>
                                    @else
                                        <p>No active bookings found.</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </section>
            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <p>
                                {{ $product->deskripsi }}
                            </p>

                        </div>
                    </div>
                </div>
            </section>
        @endsection
