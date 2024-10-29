@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Permissons</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Permissions</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif


    <section class="section">
        <a href="{{ route('permissions.create') }}" class="btn btn-primary"
            style="margin-bottom: 20px; margin-left: 890px;">New
            Permission</a>
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
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->created_at }}</td>

                                    <td>
                                        <div class="buttons">
                                            
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn icon btn-primary"><i
                                                    class="bi bi-pencil"></i></a>

                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn icon btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this brand?')">
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
