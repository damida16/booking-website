@extends('layouts.app')
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Add New Product</h2>
                <p class="dashboard-subtitle">
                    Create your own product
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <form
                            action="{{ isset($product) ? route('dashboard.products.update', $product->id) : route('dashboard.products.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($product))
                                @method('PUT') <!-- Use PUT method for updates -->
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Product Name</label>
                                                <input type="text" class="form-control" id="nama"
                                                    aria-describedby="nama" name="nama"
                                                    value="{{ old('nama', $product->nama ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <input type="text" class="form-control" id="kategori" name="kategori"
                                                    value="{{ old('kategori', $product->kategori ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="model">Model</label>
                                                <input type="text" class="form-control" id="model" name="model"
                                                    value="{{ old('model', $product->model ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="serial_number">Serial Number</label>
                                                <input type="text" class="form-control" id="serial_number"
                                                    name="serial_number"
                                                    value="{{ old('serial_number', $product->serial_number ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deskripsi">Description</label>
                                                <textarea name="deskripsi" id="" cols="30" rows="4" class="form-control">{{ old('deskripsi', $product->deskripsi ?? '') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="foto">Foto</label>
                                                <input type="file" multiple class="form-control pt-1" id="foto"
                                                    aria-describedby="foto" name="foto" />
                                                <small class="text-muted">
                                                    Kamu dapat memilih lebih dari satu file
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-block px-5">
                                        Save Now
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
