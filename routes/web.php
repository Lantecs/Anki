<?php


use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('auth/login');
}); */

Route::get('/login', [AuthManager::class, "login"])->name('login');
Route::post('/login', [AuthManager::class, "loginPost"])->name('login.post');
Route::get('/logout', [AuthManager::class, "logout"])->name('logout');

Route::get('/register', [AuthManager::class, "register"])->name('register');
Route::post('/register', [AuthManager::class, "registerPost"])->name('register.post');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('dashboard/home');
    })->name('home');

    Route::get('/', function () {
        return view('dashboard/home');
    });

    Route::get('/studyboard', function () {
        return view('dashboard/studyboard');
    })->name('studyboard');

    Route::get('/decksmanagement', function () {
        return view('dashboard/decksmanagement');
    })->name('decksmanagement');

    Route::get('/statistics', function () {
        return view('dashboard/statistics');
    })->name('statistics');

    Route::get('/settings', function () {
        return view('dashboard/settings');
    })->name('settings');

});


