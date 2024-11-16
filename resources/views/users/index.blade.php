@extends('layouts.app')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Manage Users</h2>
                <p class="dashboard-subtitle">
                    Manage all users access on this app
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-success">Add New User</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        @foreach ($users as $user)
                            <a class="card card-list d-block" href="{{ route('dashboard.users.show', $user->id) }}">
                                <div class="card-body py-2 px-4">
                                    <div class="flex row items-center">
                                        <!-- Column for Profile Picture (size 1) -->
                                        <div class="col-md-1">
                                            @if ($user->profile_picture)
                                                <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture"
                                                    class="img-fluid rounded-circle"
                                                    style="max-width: 50px; height: auto;  aspect-ratio: 1 / 1; object-fit:cover;" />
                                            @else
                                                <img src="{{ asset('/images/profile-pic.png') }}"
                                                    alt="Default Profile Picture" class="img-fluid rounded-circle"
                                                    style="max-width: 50px; height: auto;" />
                                            @endif
                                        </div>

                                        <!-- Column for Name (adjusted to col-md-3) -->
                                        <div class="col-md-4">
                                            {{ $user->name }}
                                        </div>

                                        <!-- Column for Email (adjusted to col-md-3) -->
                                        <div class="col-md-4">
                                            {{ $user->email }}
                                        </div>

                                        <!-- Column for Role (adjusted to col-md-2) -->
                                        <div class="col-md-2">
                                            {{ $user->getRoleNames()->isNotEmpty() ? $user->getRoleNames()->first() : '' }}
                                        </div>

                                        <!-- Column for Arrow Icon (adjusted to col-md-1) -->
                                        <div class="col-md-1 d-none d-md-block">
                                            <img src="{{ asset('/images/dashboard-arrow-right.svg') }}" alt="Arrow Icon" />
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
