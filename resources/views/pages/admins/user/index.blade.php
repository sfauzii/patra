@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Users</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Users</a></li>
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
        <a href="{{ route('user.create') }}" class="btn btn-primary" style="margin-bottom: 20px; margin-left: 890px;">New
            User</a>
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
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Created At</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->roles) && $user->roles->count() > 0)
                                            @foreach ($user->roles as $role)
                                                <span class="badge bg-primary">{{ $role->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-black">No roles assigned</span>
                                        @endif
                                    </td>

                                    <td>{{ $user->created_at }}</td>

                                    <td>
                                        <div class="buttons">
                                            <a href="{{ route('user.show', encrypt($user->id)) }}"
                                                class="btn icon btn-success"><i class="bi bi-eye-fill"></i></a>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn icon btn-primary"><i
                                                    class="bi bi-pencil"></i></a>


                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn icon btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this brand?')">
                                                    <i class="bi bi-x"></i>
                                                </button>
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
