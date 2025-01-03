@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Brands</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <section class="section">

        @can('create-brand')
            <a href="{{ route('brands.create') }}" class="btn btn-primary" style="margin-bottom: 20px; margin-left: 890px;">New
                Brand</a>
        @endcan

        <div class="card">
            <div class="card-header">
                {{-- <h5 class="card-title">
                    Simple Datatable
                </h5> --}}
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Icon Brand</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ ucwords($brand->name) }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td><img src="{{ asset('storage/' . $brand->icon_images) }}" alt="{{ $brand->name }}"
                                        style="width: 100px;"></td>
                                <td>
                                    <div class="buttons">
                                        @can('edit-brand')
                                            <a href="{{ route('brands.edit', $brand->id) }}" class="btn icon btn-primary"><i
                                                    class="bi bi-pencil"></i></a>
                                        @endcan

                                        @can('delete-brand')
                                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn icon btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this brand?')">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
