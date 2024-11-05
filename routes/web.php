<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admins\ItemController;
use App\Http\Controllers\Admins\RoleController;
use App\Http\Controllers\Admins\TypeController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Admins\BrandController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\Admins\BookingController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\PermissionController;
use App\Http\Controllers\ItemController as CatalogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/item/{slug}', [CatalogController::class, 'show'])->name('item.details');

Route::group(['middleware' => 'auth'], function () {
    Route::get('checkout/{slug}', [CheckoutController::class, 'index'])->name('checkout');
    
});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('brands', BrandController::class);
    Route::resource('types', TypeController::class);
    Route::resource('items', ItemController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionsToRole'])->name('roles.give-permission');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionsToRole'])->name('roles.update-permission');
    Route::resource('permissions', PermissionController::class);
    Route::resource('user', UserController::class);
});

// Auth::routes();
Route::auth(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::post('midtrans/callback', [MidtransController::class, 'callback']);
Route::get('midtrans/finish', [MidtransController::class, 'finishRedirect']);
Route::get('midtrans/unfinish', [MidtransController::class, 'unfinishRedirect']);
Route::get('midtrans/failed', [MidtransController::class, 'errorRedirect']);
