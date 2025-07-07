<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminDashboardController;


Route::get('/', function () {
    return view('landing-page');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('role:administrator')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // ACCOUNT CREATION
     

        // ADMINISTRATOR ROUTES
Route::middleware(['auth', 'verified', 'role:administrator'])->prefix('admin')->group(function () {
    Route::resource('users', AdminUserController::class)->except(['show']);
         });
    });

Route::middleware(['auth','verified', 'role:administrator'])->prefix('admin')->name('admin.')->group(function () {

    // USER CONTROLS
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/search', [AdminUserController::class, 'search'])->name('users.search'); // ← for AJAX
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('users.store'); // ← this is the missing route
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // INSIGHTS AND ADMIN DASHBOARD
    Route::middleware(['auth', 'role:administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });
});



    //EDITOR
    Route::middleware('role:editor')->group(function () {
        Route::get('/editor/dashboard', [EditorController::class, 'index'])->name('editor.dashboard');
        // editor tools here...
    });


//     Route::prefix('editor')->middleware(['auth', 'role:editor'])->group(function () {
//     Route::get('/equipments', ...)->name('editor.equipments');
// });




    //USER
    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
        // user equipment listings, orders...
    });


//     Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/equipments', ...)->name('user.equipments');
//     Route::get('/orders', ...)->name('user.orders');
// });

});







// 🟡 Shows the verify-email notice to logged-in users who aren't verified
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// 🟢 Handles the actual email verification from the link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->intended(); // ← Will return to originally intended page
})->middleware(['auth', 'signed'])->name('verification.verify');



// 🔁 Resends verification email (POST only — must use form, not link!)
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



