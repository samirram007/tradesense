<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/frontend.php';

//cache clear
Route::get('/clear_cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Cache is cleared';
});
//storage link
Route::get('/storage_link', function() {
    $exitCode = Artisan::call('storage:link');
    return 'Storage is linked';
});
//migrate
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate:refresh --seed');
    return 'Migration is done';
});
