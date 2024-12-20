<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Sangfor - Login Page</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="{{ asset('style/main.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('/images/logo-shape.png') }}" style="width: 40px; height: 40px;" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories.html">Categories</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="page-content page-auth">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('/images/sangfor-login.png') }}" alt=""
                            class="w-50 mb-4 mb-lg-none" />
                    </div>


                    <div class="col-lg-5">
                        <h2>
                            Log In

                        </h2>
                        <form method="POST" action="{{ route('login') }}" id="login-form"class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name = "email" class="form-control w-75"
                                    aria-describedby="emailHelp" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control w-75" />
                            </div>

                            <a href="{{ route('login') }}" class="btn btn-success btn-block w-75 mt-4"
                                onclick="event.preventDefault(); document.getElementById('login-form').submit();"
                                style="cursor: pointer;">
                                Sign In to My Account

                                <a class="btn btn-signup w-75 mt-2" href="/register.html">
                                    Sign Up
                                </a>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="pt-4 pb-2">
                        2019 Copyright Store. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="{{ asset('script/navbar-scroll.js') }}"></script>
</body>

</html>
