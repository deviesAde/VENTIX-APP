<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');


Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'organizer') {
        return redirect()->route('organizer.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');




Route::prefix('admin')->middleware(['auth', CheckRole::class.':admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('admin.users.index');

    Route::get('/events', function () {
        return view('admin.events.index');
    })->name('admin.events.index');

    Route::get('/organizers', function () {
        return view('admin.organizers.index');
    })->name('admin.organizers.index');
    //logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('admin.logout');
});

Route::middleware(['auth', CheckRole::class.':organizer'])->group(function () {
    Route::get('/organizer/dashboard', [OrganizerController::class, 'index'])->name('organizer.dashboard');
    //prefix
    Route::prefix('organizer')->group(function () {

    });
});

Route::middleware(['auth', CheckRole::class.':user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    // Route::prefix('user')->group(function () {
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});
require __DIR__.'/auth.php';
