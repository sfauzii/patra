@extends('layouts.admin')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Profile Statistics</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Brand</h6>
                                        <h6 class="font-extrabold mb-0">{{ $brandCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Type</h6>
                                        <h6 class="font-extrabold mb-0">{{ $typeCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Cars</h6>
                                        <h6 class="font-extrabold mb-0">{{ $itemCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Bookings</h6>
                                        <h6 class="font-extrabold mb-0">{{ $bookingCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">

                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Review</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Cars</th>
                                                <th>Comment</th>
                                                <th>Rating</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latestReviews as $review)
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ $review->user->profile_photo_url ?? 'https://api.dicebear.com/6.x/initials/svg?seed=' . urlencode($review->user->name) }}"
                                                                    alt="{{ $review->user->name }}">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">{{ $review->user->name }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class="mb-0">{{ $review->item->name }}</p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class="mb-0">{{ $review->message }}</p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <!-- Display Rating as Star Icons -->
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= floor($review->rating))
                                                                <!-- Full star -->
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                            @elseif ($i == ceil($review->rating))
                                                                <!-- Half star -->
                                                                <i class="bi bi-star-half text-warning"></i>
                                                            @else
                                                                <!-- Empty star -->
                                                                <i class="bi bi-star"></i>
                                                            @endif
                                                        @endfor
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class="mb-0">{{ $review->created_at }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ $user->profile_photo_url ?? 'https://api.dicebear.com/6.x/initials/svg?seed=' . urlencode($user->name) }}"
                                    alt="{{ ucwords($user->name) }}">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ ucwords($user->name) }}</h5>
                                <h6 class="text-muted mb-0">{{ ucwords($user->roles->first()->name) }}</h6>

                                <div class="ms-auto">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="btn btn-danger btn-sm ms-3">
                                        Logout
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </section>
    </div>
@endsection
