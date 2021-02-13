<?php

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

Route::get('/', function () {
    return redirect()->route('register');
});

//Confirm email verification
Route::post('/confirmEmailVerification', 'EmailOtpController@confirmEmail')->name('verifyEmail');

//resend email verification
Route::get("/resend-verification-email", "EmailOtpController@resendVerification")->name("resend-verification");

Route::get("/unsubscribe", "SubscriberController@unsubscribe")->name("unsubscribe");

Route::get("/stop-sending-movies/{user_id}", "SubscriberController@stopSendingMovies")->name("stopSendingMovies");

//playing ground url
Route::get('/test', 'HomeController@test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
