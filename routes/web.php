<?php

use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Organizer\SalesStatsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminOrganizerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Organizer\OrganizerDashboardController;
use App\Http\Controllers\Organizer\OrganizerProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserProfileController;
use App\Models\Organizer;
use App\Http\Controllers\EventRegistrationController;

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

    Route::get('/organizers', function () {
        return view('admin.organizers.index');
    })->name('admin.organizers.index');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('admin.logout');

    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::get('/events/{event}', [AdminEventController::class, 'show'])->name('admin.events.show');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');

    Route::get('/organizers', [AdminOrganizerController::class, 'index'])->name('admin.organizers.index');
    Route::post('/organizers/{id}/approve', [AdminOrganizerController::class, 'approve'])->name('admin.organizers.approve');
    Route::post('/organizers/{id}/reject', [AdminOrganizerController::class, 'reject'])->name('admin.organizers.reject');
    Route::delete('/organizers/{id}', [AdminOrganizerController::class, 'destroy'])->name('admin.organizers.destroy');


    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');



});

Route::middleware(['auth', CheckRole::class.':organizer'])->group(function () {
    Route::prefix('organizer')->group(function () {
        Route::get('/dashboard', [OrganizerDashboardController::class, 'dashboard'])->name('organizer.dashboard');
        Route::get('/events', [OrganizerDashboardController::class, 'index'])->name('organizer.events');
        Route::put('/events/{id}', [OrganizerDashboardController::class, 'update'])->name('organizer.events.update');
        Route::get('/events/create', [OrganizerDashboardController::class, 'create'])->name('organizer.events.create');
        Route::post('/events/create', [OrganizerDashboardController::class, 'storeEvent'])->name('organizer.events.store');

        Route::get('/profile', [OrganizerProfileController::class, 'edit'])->name('organizer.profile');
        Route::put('/profile/update', [OrganizerProfileController::class, 'update'])->name('organizer.profile.update');


        //stats
        Route::get('/stats', [SalesStatsController::class, 'index'])->name('organizer.statistics');

        //delete
        Route::delete('/events/{id}', [OrganizerDashboardController::class, 'destroy'])->name('organizer.events.destroy');
        Route::get('/scan', [EventRegistrationController::class, 'showScanner'])->name('organizer.scan');
    Route::post('/scan/verify', [EventRegistrationController::class, 'verifyTicket'])->name('organizer.scan.verify');
    Route::post('/scan/check-in', [EventRegistrationController::class, 'checkIn'])->name('organizer.scan.check-in');
    Route::get('/scan/manual', [EventRegistrationController::class, 'showManualEntry'])->name('organizer.scan.manual');
    Route::post('/scan/manual', [EventRegistrationController::class, 'processManualEntry'])->name('organizer.scan.manual.process');

});

 });


Route::middleware(['auth', CheckRole::class.':user'])->group(function () {
route::prefix('user')->group(function () {
Route::get('/events', [UserController::class, 'index'])->name('user.dashboard');
// routes/web.php

Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
Route::get('/events/ticket/{registration}', [EventController::class, 'ticket'])->name('events.ticket');
Route::post('/payment/callback', [EventController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/payments/{payment}/retry', [EventController::class, 'retryPayment'])->name('payment.retry');
;





Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
});
});




require __DIR__.'/auth.php';
