@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Items</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Items</a></li>
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

                                @if ($errors->any())
                                    <div class="mb-5" role="alert">
                                        <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                                            Ada kesalahan!
                                        </div>
                                        <div
                                            class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                                            <p>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                <form action="{{ route('items.update', $item->id) }}" method="POST"
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
                                                    name="name" placeholder="Name"
                                                    value="{{ old('name') ?? $item->name }}">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Brand</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="input-group mb-3">
                                                    {{-- <label class="input-group-text" for="inputGroupSelect01">Options</label> --}}
                                                    <select name="brand_id" class="form-select" id="inputGroupSelect01">
                                                        <option value="{{ $item->brand->id }}">Tidak Diubah
                                                            ({{ $item->brand->name }})</option>
                                                        ({{ $item->brand->name }})</option>
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}"
                                                                {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                                {{ $brand->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Type</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="input-group mb-3">
                                                    {{-- <label class="input-group-text" for="inputGroupSelect01">Options</label> --}}
                                                    <select name="type_id" class="form-select" id="inputGroupSelect01">
                                                        <option value="{{ $item->type->id }}">Tidak Diubah
                                                            ({{ $item->type->name }})</option>
                                                        @foreach ($types as $type)
                                                            <option value="{{ $type->id }}"
                                                                {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                                                {{ $type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Description</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea type="text" name="description" class="form-control" type="text" placeholder="Description"
                                                    id="floatingTextarea" value="{{ old('description') ?? $item->description }}"></textarea>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Features</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="features" placeholder="Feature"
                                                    value="{{ old('features') ?? $item->features }}">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Price</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="first-name-horizontal" class="form-control"
                                                    name="price" placeholder="Price"
                                                    value="{{ old('price') ?? $item->price }}">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Star</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="first-name-horizontal" class="form-control"
                                                    name="star" placeholder="Rating"
                                                    value="{{ old('star') ?? $item->star }}" min="1" max="5"
                                                    step=".01">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Review</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="first-name-horizontal" class="form-control"
                                                    name="review" placeholder="Review"
                                                    value="{{ old('review') ?? $item->review }}" min="0">
                                            </div>

                                            <div class="col-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <p class="card-title"
                                                            style="font-weight: bold; margin-left: -20px;">
                                                            Photos</p>
                                                        <p class="card-text" style="margin-left: -20px;">Kamu bisa upload
                                                            lebih
                                                            dari satu foto
                                                        </p>
                                                    </div>
                                                    <div class="card-content">

                                                        <div class="card-body"
                                                            style="margin-top: -15px; margin-left: -20px">

                                                            <!-- File uploader with multiple files upload -->
                                                            <input type="file" name="photos[]"
                                                                class="image-preview-filepond" {{-- accept="image/png, image/jpeg, image/jpg, image/webp" --}}
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button item="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button item="reset" class="btn btn-light-secondary me-1 mb-1"
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
                                    <p><strong>Created At:</strong> {{ $item->created_at->format('d-m-Y H:i:s') }}</p>
                                    <p><strong>Updated At:</strong> {{ $item->updated_at->format('d-m-Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
