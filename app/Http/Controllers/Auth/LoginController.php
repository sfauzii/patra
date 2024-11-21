<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {


        if ($user->hasRole('user')) {
            // If the user has the 'user' role, allow login and redirect to the user dashboard
            return redirect('/'); // Update with your user dashboard route
        }

        // Log out the user if they don't have the 'user' role
        Auth::logout();

        // Set a SweetAlert message for unauthorized access
        Alert::error('Access Denied', 'Access restricted to regular users only.');

        // Redirect back to login with an error message
        return redirect()->back();
    }
}
