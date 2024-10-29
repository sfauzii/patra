@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Add User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
                <li class="breadcrumb-item">User</li>
                {{-- <li class="breadcrumb-item active">Elements</li> --}}
            </ol>
        </nav>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">General Form Elements</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="Name"
                                        value="{{ old('name') }}">
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <label for="username" class="col-sm-2 col-form-label">Username <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        value="{{ old('username') }}">
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input name="email" type="email" class="form-control" placeholder="Email"
                                        value="{{ old('email') }}"></input>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Password <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input name="password" type="password" class="form-control" placeholder="Password"
                                        required autocomplete="new-password" {{ old('password') }}></input>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Passowrd <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input name="password_confirmation" type="password" placeholder="Confirm Password"
                                        class="form-control" required autocomplete="new-password"
                                        {{ old('password-confirm') }}></input>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Roles <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value="">Select Roles</option>
                                        @foreach ($roles as $id => $role)
                                            <option value="{{ $id }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary btn-block w-100">
                                Simpan
                            </button>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
