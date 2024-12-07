@extends('layouts.home')

@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
        <section class="store-carousel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="zoom-in">
                        <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#storeCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#storeCarousel" data-slide-to="1"></li>
                                <li data-target="#storeCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/images/banner.jpg" class="d-block w-100" alt="Carousel Image" />
                                </div>
                                <div class="carousel-item">
                                    <img src="/images/banner.jpg" class="d-block w-100" alt="Carousel Image" />
                                </div>
                                <div class="carousel-item">
                                    <img src="/images/banner.jpg" class="d-block w-100" alt="Carousel Image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Categories</h5>
                    </div>
                </div>
                <div class="row">
                    <!-- All Categories Option -->
                    <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <div class="component-categories d-block category-card selected" data-category="all">
                            <div class="categories-image">
                                <img src="/images/categories-gadgets.svg" alt="All Categories" class="w-100" />
                            </div>
                            <p class="categories-text">
                                All
                            </p>
                        </div>
                    </div>
                    <!-- Dynamic Categories -->
                    @foreach ($categories as $category)
                        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="100">
                            <div class="component-categories d-block category-card" data-category="{{ $category }}">
                                <div class="categories-image">
                                    <img src="/images/categories-gadgets.svg" alt="{{ $category }} Categories"
                                        class="w-100" />
                                </div>
                                <p class="categories-text">
                                    {{ $category }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Products</h5>
                    </div>
                </div>
                <div class="row" id="products-list">
                    @foreach ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 product-item" data-category="{{ $product->kategori }}"
                            data-aos="fade-up" data-aos-delay="100">
                            <a class="component-products d-block" href="{{ route('home.detailProduct', $product->id) }}">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style="background-image: url('{{ Storage::url($product->foto) }}');">
                                    </div>
                                </div>
                                <div class="products-text">
                                    {{ $product->nama }}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle category card selection
            $('.category-card').on('click', function(e) {
                e.preventDefault(); // Prevent the default anchor behavior

                // Remove 'selected' class from all category cards
                $('.category-card').removeClass('selected');

                // Add 'selected' class to the clicked category card
                $(this).addClass('selected');

                // Get the selected category
                const selectedCategory = $(this).data('category');

                // Filter products
                if (selectedCategory === 'all') {
                    // Show all products if "All Categories" is selected
                    $('.product-item').show();
                } else {
                    // Show only products matching the selected category
                    $('.product-item').hide();
                    $(`.product-item[data-category="${selectedCategory}"]`).show();
                }
            });
        });
    </script>
@endsection
