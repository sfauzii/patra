@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Create Brands</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Brands</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-8 col-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4 class="card-title">Horizontal Form</h4>
                        </div> --}}
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('brands.update', $brand->id) }}" method="POST"
                                    class="form form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Name</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="name" placeholder="Brand Name"
                                                    value="{{ old('name') ?? $brand->name }}">
                                            </div>

                                            <div class="col-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <p class="card-title"
                                                            style="font-weight: bold; margin-left: -20px;">
                                                            Icon Brand</p>
                                                        {{-- <p class="card-text" style="margin-left: -20px;">Kamu bisa upload lebih
                                                        dari satu foto
                                                    </p> --}}
                                                    </div>
                                                    <div class="card-content">

                                                        <div class="card-body"
                                                            style="margin-top: -15px; margin-left: -20px">

                                                            @if (isset($brand->icon_images))
                                                                <div class="mb-3">
                                                                    <label>Current Image:</label>
                                                                    <img src="{{ asset('storage/' . $brand->icon_images) }}"
                                                                        alt="Current Image" width="100">
                                                                </div>
                                                            @endif

                                                            <!-- File uploader for uploading a new image -->
                                                            <input type="file" name="icon_images"
                                                                class="image-preview-filepond" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1"
                                                    onclick="window.history.back();">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="card-content">
                                <div class="card-body">
                                    <p><strong>Created At:</strong> {{ $brand->created_at->format('d-m-Y H:i:s') }}</p>
                                    <p><strong>Updated At:</strong> {{ $brand->updated_at->format('d-m-Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endsection
