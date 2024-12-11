<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admins\ItemController;
use App\Http\Controllers\Admins\RoleController;
use App\Http\Controllers\Admins\TypeController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Auth\AdminsController;
use App\Http\Controllers\Admins\BrandController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\CheckBookingController;
use App\Http\Controllers\Admins\ReportController;
use App\Http\Controllers\Admins\BookingController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\PermissionController;
use App\Http\Controllers\ContactController;
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
Route::get('/car/{slug}', [CatalogController::class, 'show'])->name('item.details');
Route::get('/check-booking', [CheckBookingController::class, 'index'])->name('check-booking')
    ->middleware('auth');

Route::get('/cars', [CarsController::class, 'cars'])->name('cars');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

Route::get('/view-brands/{brand:name}', [HomeController::class, 'view'])->name('view.brands');

Route::group(['middleware' => 'auth'], function () {
    Route::get('c/{slug}', [CheckoutController::class, 'index'])->name('checkout');
});

Route::get('about', [HomeController::class, 'about'])->name('about');


Route::get('/dashboard/login', [AdminsController::class, 'loginForm'])->name('admins-form');
Route::post('/dashboard/login', [AdminsController::class, 'login'])->name('admins-login');
Route::post('/admin-logout', [AdminsController::class, 'logoutAdmins'])->name('admin-logout');


Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('brands', BrandController::class);
    Route::resource('types', TypeController::class);
    Route::resource('items', ItemController::class);
    Route::put('/items/{item}/toggle-availability', [ItemController::class, 'toggleAvailability'])
        ->name('items.toggle-availability');

    Route::resource('bookings', BookingController::class);
    Route::put('/bookings/{booking}/updateDocument', [BookingController::class, 'updateDocument'])->name('bookings.updateDocument');
    Route::put('/bookings/{booking}/rejectDocument', [BookingController::class, 'rejectDocument'])->name('bookings.rejectDocument');

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionsToRole'])->name('roles.give-permission');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionsToRole'])->name('roles.update-permission');
    Route::resource('permissions', PermissionController::class);
    Route::resource('user', UserController::class);

    Route::get('reports/order-booking', [ReportController::class, 'showFormOrderBooking'])->name('reports.order-booking');
    Route::get('reports/order-booking/download', [ReportController::class, 'generateOrderPdf'])->name('reports.order-booking.download');

    Route::get('reports/item-cars', [ReportController::class, 'showFormItem'])->name('reports.item-cars');
    Route::get('reports/item-cars/download', [ReportController::class, 'generateItemPdf'])->name('reports.item-cars.download');
});

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');

// Auth::routes();
Route::auth(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::post('midtrans/callback', [MidtransController::class, 'callback']);
Route::get('midtrans/finish', [MidtransController::class, 'finishRedirect']);
Route::get('midtrans/unfinish', [MidtransController::class, 'unfinishRedirect']);
Route::get('midtrans/failed', [MidtransController::class, 'errorRedirect'])->name('pages.redirect.failed');
