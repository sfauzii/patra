<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::user() || !Auth::user()->can($permission)) {

            Alert::error('Access Denied', 'You do not have permission to access this page.');
            // Set alert message
            // session()->flash('alert', [
            //     'type' => 'error',
            //     'message' => 'Access Denied. You do not have permission to view this page.'
            // ]);

            // Redirect back to previous page or home
            return redirect()->back();
        }

        return $next($request);
    }
}
