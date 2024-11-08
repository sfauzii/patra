<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckBookingController extends Controller
{
    public function index() {

        return view('check-booking');
    }
}
