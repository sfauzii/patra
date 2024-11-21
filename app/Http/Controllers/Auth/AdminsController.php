<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminsController extends Controller
{
    public function loginForm()
    {

        return view('auth.admins.login-admins');
    }

    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user(); // Get the authenticated user

            // Check if the user has the 'login dashboard' permission
            if ($user->hasPermissionTo('login dashboard')) {

                // Get the role name dynamically (assuming one role per user)
                $roleName = $user->getRoleNames()->first();

                // Redirect to a dynamic URL based on the role name
                return redirect()->route('dashboard', ['role' => $roleName]);
            }

            // Log out the user if they don't have the appropriate role
            Auth::logout();
            Alert::error('Access Denied', 'Access restricted to administrators only.');
            return redirect()->back();
        }

        // Authentication failed, show an error alert
        Alert::error('Login Failed', 'Invalid credentials provided.');
        return redirect()->back()->withInput($request->only('username'));
    }

    public function logoutAdmins(Request $request)
    {
        Auth::logout(); // Log out the user

        // Invalidate the session and regenerate token to avoid session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the specified route
        return redirect()->route('admins-form');
    }
}
