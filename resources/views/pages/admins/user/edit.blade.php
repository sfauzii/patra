@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Edit User</h1>
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
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">General Form Elements</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="name"
                                        value="{{ $user->name }}">
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <label for="username" class="col-sm-2 col-form-label">Username <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        value="{{ $user->username }}">

                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input name="email" type="email" placeholder="Email" class="form-control"
                                        value="{{ $user->email }}"></input>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Roles <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value="">Select Roles</option>
                                        @foreach ($roles as $role => $roleName)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                {{ $roleName }}
                                            </option>
                                        @endforeach
                                        {{-- @foreach ($roles as $id => $role)
                                            <option value="{{ $id }}"
                                                {{ in_array($id, $userRoles) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Roles</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="roles" id="admin_role"
                                            value="ADMIN" {{ $user->roles == 'ADMIN' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="admin_role">
                                            ADMIN
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="roles" id="user_role"
                                            value="USER" {{ $user->roles == 'USER' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="user_role">
                                            USER
                                        </label>
                                    </div>
                                    <!-- Add more radio buttons as needed -->
                                </div>
                            </div> --}}



                            <div class="row mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Password <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input name="password" type="password" class="form-control"
                                        autocomplete="new-password"></input>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Passowrd <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input name="password_confirmation" type="password" class="form-control"
                                        autocomplete="new-password"></input>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block w-100">
                                Simpan
                            </button>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Last Information</h5>

                        <!-- Advanced Form Elements -->
                        <form>
                            <!-- Created At -->
                            <div class="row mb-5">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span> <i class="ri-calendar-schedule-line"></i> Created At: <span
                                                style="color: #012970; font-weight: bold   ">{{ $user->created_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
                                        <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                    </div>
                                </div>
                            </div>

                            <!-- Updated At -->
                            <div class="row mb-5">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span><i class="ri-calendar-schedule-line"></i> Updated At: <span
                                                style="color: #012970; font-weight: bold   ">{{ $user->updated_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
                                        <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
