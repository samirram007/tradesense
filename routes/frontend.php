<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/trading', [FrontendController::class, 'trading'])->name('trading');

Route::group(['middleware' => 'guest'],function(){
Route::post('/send_link/email', [RegisterController::class, 'send_link_email'])->name('send_link.email');
Route::get('/confirm_link/{code}', [RegisterController::class, 'confirm_registration_link'])->name('confirm_link');
Route::post('/register_through_link', [RegisterController::class, 'register_through_link'])->name('register_through_link');

Route::post('/get_sponsor', [RegisterController::class, 'get_sponsor'])->name('get_sponsor');

Route::post('login', [LoginController::class, 'login'])->name('login.store');



});
