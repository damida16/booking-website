@extends('layouts.app')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title py-2">{{ isset($user) ? 'Edit User' : 'Add New User' }}</h2>
            </div>
            <div class="dashboard-content mt-4">
                <div class="row">
                    <div class="col-12">
                        <form
                            action="{{ isset($user) ? route('dashboard.users.update', $user->id) : route('dashboard.users.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($user))
                                @method('PUT') <!-- Use PUT method for updates -->
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $user->name ?? '') }}" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $user->email ?? '') }}" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    {{ isset($user) ? '' : 'required' }} />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="confirm-password">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirm-password"
                                                    name="password_confirmation" {{ isset($user) ? '' : 'required' }} />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select name="role" id="role" class="form-control" required>
                                                    <option value="" disabled {{ !isset($user) ? 'selected' : '' }}>
                                                        Select a role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            {{-- <div class="form-group">
                                                <label for="profile-picture" class="form-label">Foto Profil</label>
                                                <input type="file" class="form-control" id="profile-picture"
                                                    name="profile_picture" accept="image/*" />
                                                <div class="mt-2 text-muted small">
                                                    <i class="bi bi-info-circle"></i> Supported formats: JPEG, PNG, JPG,
                                                    GIF, SVG.
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="profile_picture">Foto Profil</label>
                                                <input type="file" accept="image/*" class="form-control pt-1"
                                                    id="profile_picture" name="profile_picture" />
                                                <small class="text-muted">
                                                    Supported formats: JPEG, PNG, JPG,
                                                    GIF, SVG.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-block px-5">
                                        {{ isset($user) ? 'Update User' : 'Save Now' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
