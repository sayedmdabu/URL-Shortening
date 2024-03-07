<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\URLController;

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

Route::get('/', function () {
    // return view('shorten');
    return redirect()->route('shorten');
});

Route::get('/shorten', function () {
    return view('shorten');
});

Route::post('/shorten', [URLController::class, 'shorten'])->name('shorten');

// Define route for dynamic short URLs
Route::get('/base/{shortUrl}', [URLController::class, 'redirectShortUrl'])->name('redirect.shortUrl');

