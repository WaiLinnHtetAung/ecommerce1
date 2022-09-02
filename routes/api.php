<?php
// use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
// });
// Route::middleware(['auth:sanctum'])->group(function () {
//     // Route::auth();
//     Route::get('/user', 'AuthController@user');
//     Route::post('/user/logout', 'AuthController@logoutUser');
// });
// Route::controller(AuthController::class)->group(function () {
//     Route::post('/user/add', 'register')->name('user.register');
//     Route::post('/user/login', 'loginUser')->name('user.loginUser');
//     Route::post('/user/login/otp', 'generate')->name('user.login.otp');
//     Route::post('/user/login/otp/verification', 'verificationOtp')->name('user.login.otp.verification');
// });
// Route::controller(CommentController::class)->group(function () {
//     Route::get('/user/unreadNotifications', 'unreadNotifications');
// });
