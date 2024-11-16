@extends('layouts.app')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title  ">User Details</h2>
            </div>
            <div class="dashboard-content mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                value="{{ $user->name }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                value="{{ $user->email }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <input type="text" class="form-control" id="role"
                                                value="{{ $user->getRoleNames()->first() }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="created_at">Created At</label>
                                            <input type="text" class="form-control" id="created_at"
                                                value="{{ $user->created_at->format('d M Y') }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-primary">Back to User
                                            List</a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                            class="btn btn-warning ml-2">
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST"
                                            class="d-inline ml-2"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
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
