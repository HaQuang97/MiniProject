<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'user'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('register','AuthController@register');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('forgot/password', 'ForgotPassWordController')->name('forgot.password');
//    Route::post('reset/password', 'ForgotPassWordController@reset');
    Route::post('confirm/password','AuthController@updatePassword');


});

Route::group([

    'middleware' => 'api',
    'prefix' => 'project'

], function () {

    Route::post('store','ProjectController@store');

});