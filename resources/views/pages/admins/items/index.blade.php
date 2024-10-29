@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Items</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Items</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <a href="{{ route('items.create') }}" class="btn btn-primary"
                style="margin-bottom: 20px; margin-left: 890px;">New Item</a>
            <div class="card">
                <div class="card-header">
                    {{-- <h5 class="card-title">
                        {{~~ jQuery Datatable ~~}}
                    </h5> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Photos</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->brand->name }}</td>
                                        <td>{{ $item->type->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            @if ($item->photos)
                                                @foreach (json_decode($item->photos) as $photo)
                                                    <div class="relative group">
                                                        <img src="{{ asset('storage/' . $photo) }}" alt="Product Photo"
                                                           style="width: 100px; margin-right: 5px; margin-bottom: 5px" class="img-thumbnail" >
                                                        <div
                                                            class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-20 transition duration-300">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-gray-500">No photos available</p>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="buttons">
                                                <a href="{{ route('items.edit', $item->id) }}"
                                                    class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>

                                                <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button item="submit" class="btn icon btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    @endsection
