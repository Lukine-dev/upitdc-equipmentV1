<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\EquipmentController as AdminEquipmentController;
use App\Http\Controllers\Editor\EquipmentController as EditorEquipmentController;
use App\Http\Controllers\Admin\AdminRentalController;
use App\Http\Controllers\User\UserRentalController;
use App\Http\Controllers\User\EquipmentController;


// 🟢 Public Landing Page
Route::get('/', function () {
    return view('landing-page');
});

// 🟢 Auth (Breeze/UI)
Auth::routes();

// 🟢 Default Authenticated Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 🔒 Authenticated + Verified Routes
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMINISTRATOR ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:administrator')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // User Management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/search', [AdminUserController::class, 'search'])->name('users.search');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // Equipment Management
        Route::prefix('/equipments')->name('equipments.')->group(function () {
            Route::get('/', [AdminEquipmentController::class, 'index'])->name('index');
            Route::get('/create', [AdminEquipmentController::class, 'create'])->name('create');
            Route::post('/', [AdminEquipmentController::class, 'store'])->name('store');
            Route::get('/{equipment}', [AdminEquipmentController::class, 'show'])->name('show');
            Route::get('/{equipment}/edit', [AdminEquipmentController::class, 'edit'])->name('edit');
            Route::put('/{equipment}', [AdminEquipmentController::class, 'update'])->name('update');
            Route::delete('/{equipment}', [AdminEquipmentController::class, 'destroy'])->name('destroy');
        });
    });

    Route::middleware(['auth', 'role:administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/rental-requests', [AdminRentalController::class, 'index'])->name('rental.index');
    Route::get('/rental-requests/{id}/form', [AdminRentalController::class, 'showRequestForm'])->name('rental.form');
    Route::post('/rental-requests/{id}/approve', [AdminRentalController::class, 'approve'])->name('rental.approve');
    Route::get('/rentals/{id}/pdf', [AdminRentalController::class, 'downloadForm'])->name('rental.downloadForm');
    });

    Route::middleware(['auth', 'verified', 'role:administrator'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/rentals', [AdminRentalController::class, 'index'])->name('rentals.index');
        Route::get('/rentals/{id}', [AdminRentalController::class, 'show'])->name('rentals.show');
        Route::post('/rentals/{id}/approve', [AdminRentalController::class, 'approve'])->name('rentals.approve');
        Route::post('/rentals/{id}/decline', [AdminRentalController::class, 'decline'])->name('rentals.decline');
        Route::post('/rentals/{id}/return', [AdminRentalController::class, 'markReturned'])->name('rentals.return');
        Route::get('/rentals/{id}/form', [AdminRentalController::class, 'downloadForm'])->name('rentals.form');
    });
    /*
    |--------------------------------------------------------------------------
    | EDITOR ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:editor')
        ->prefix('editors')
        ->name('editors.')
        ->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [EditorController::class, 'index'])->name('dashboard');

        // Equipment Management
        Route::get('/equipments', [EditorEquipmentController::class, 'index'])->name('equipments.index');
        Route::get('/equipments/create', [EditorEquipmentController::class, 'create'])->name('equipments.create');
        Route::post('/equipments', [EditorEquipmentController::class, 'store'])->name('equipments.store');
        Route::get('/equipments/{equipment}', [EditorEquipmentController::class, 'show'])->name('equipments.show');
        Route::get('/equipments/{equipment}/edit', [EditorEquipmentController::class, 'edit'])->name('equipments.edit');
        Route::put('/equipments/{equipment}', [EditorEquipmentController::class, 'update'])->name('equipments.update');
        Route::delete('/equipments/{equipment}', [EditorEquipmentController::class, 'destroy'])->name('equipments.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | USER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:user')->group(function () {
        // Dashboard
        Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

      

    });

    

   Route::middleware(['auth', 'verified', 'role:user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/rentals', [UserRentalController::class, 'index'])->name('rentals.index');
        Route::get('/rentals/create', [UserRentalController::class, 'create'])->name('rentals.create');
        Route::post('/rentals', [UserRentalController::class, 'store'])->name('rentals.store');



        // Equipments
        Route::get('/equipments', [EquipmentController::class, 'index'])->name('equipments.index');
            Route::get('/equipments/{id}', [EquipmentController::class, 'show'])->name('equipments.show');

    });
    
});



/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION ROUTES
|--------------------------------------------------------------------------
*/

// Show verification notice to unverified users
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Handle email verification from the clicked link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->intended();
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email (POST only)
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
