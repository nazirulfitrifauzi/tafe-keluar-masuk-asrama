<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\AboutUs;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Dashboard;
use App\Livewire\History;
use App\Livewire\Incoming;
use App\Livewire\Notes;
use App\Livewire\Outgoing;
use App\Livewire\PopQuiz;
use App\Livewire\Record;
use App\Livewire\Rules;
use App\Livewire\StudentDetail;
use App\Livewire\User;
use App\Livewire\Gallery;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return auth()->check() ? redirect()->route('home') : redirect()->route('login');
    });

    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('home');

    Route::get('user', User::class)->name('user');

    Route::get('pop-quiz', PopQuiz::class)->name('pop-quiz');

    Route::get('gallery', Gallery::class)->name('gallery');

    Route::get('rules', Rules::class)->name('rules');

    Route::get('about-us', AboutUs::class)->name('about-us');
});

Route::middleware('auth')->group(function () {

    Route::get('notes', Notes::class)->name('notes');

    Route::get('outgoing/{status?}', Outgoing::class)->name('outgoing');
    Route::get('incoming', Incoming::class)->name('incoming');

    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
