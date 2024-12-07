@extends('layouts.app')
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">{{ $product->nama }}</h2>
                <p class="dashboard-subtitle">
                    Product Details
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
                                                <label for="name">Product Name</label>
                                                <input type="text" class="form-control" id="nama"
                                                    aria-describedby="nama" name="nama" value="{{ $product->nama }}" />
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
                                                <input type="text" class="form-control" id="model"
                                                    aria-describedby="model" name="model" value="{{ $product->model }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="serial_number">Serial Number</label>
                                                <input type="text" class="form-control" id="serial_number"
                                                    aria-describedby="serial_number" name="serial_number"
                                                    value="{{ $product->serial_number }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deskripsi">Description</label>
                                                <textarea name="deskripsi" id="" cols="30" rows="4" class="form-control">
{{ $product->deskripsi }}
                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="foto">Foto</label>
                                                <input type="file" multiple class="form-control pt-1" id="foto"
                                                    aria-describedby="foto" name="foto" />
                                                <small class="text-muted">
                                                    Kamu dapat mengubah foto produk
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                class="btn btn-success btn-block px-5">
                                                Update Product
                                            </a>
                                        </div>

                                        <div class="col">
                                            <form action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                method="POST" class="d-inline ml-2"
                                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-block px-5">
                                                    Delete Product
                                                </button>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="gallery-container">
                                            <img src="{{ Storage::url($product->foto) }}" alt="" class="w-100" />
                                            <a class="delete-gallery" href="#">
                                                <img src="/images/icon-delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col mt-3">
                                        <input type="file" id="file" style="display: none;" multiple />
                                        <button class="btn btn-secondary btn-block" onclick="thisFileUpload();">
                                            Add Photo
                                        </button>
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
