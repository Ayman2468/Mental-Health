<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as FacadesLaravelLocalization;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\usercontroller;
use Symfony\Component\Routing\Route as RoutingRoute;

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

define('paginationcount', 5);
define('index', '');

Route::get('/', function () {
    return redirect('ar/login');
});

Route::group([
    'prefix' => FacadesLaravelLocalization::setlocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Auth::routes(['verify' => true]);
    Route::get('home', 'App\Http\Controllers\homecontroller@index')->middleware('auth', 'verified');

    Route::group(['prefix' => 'user'], function () {
        Route::group(['middleware' => 'auth'], function () {
            Route::get('edit/{userid}', 'App\Http\Controllers\usercontroller@edit');
            Route::post('update/{userid}', 'App\Http\Controllers\usercontroller@update')->name('user.update');
            Route::get('delete/{userid}', 'App\Http\Controllers\usercontroller@destroy');
            Route::get('display', 'App\Http\Controllers\usercontroller@userdisplay');
            Route::get('problems/{user_id}', 'App\Http\Controllers\usercontroller@problems')->name('user.problems');
        });
        Route::get('index', 'App\Http\Controllers\usercontroller@index')->middleware('mainadmin');
        Route::get('register', 'App\Http\Controllers\usercontroller@create');
        Route::post('store', 'App\Http\Controllers\usercontroller@store')->name('user.store');
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['middleware' => 'mainadmin'], function () {
            Route::get('index', 'App\Http\Controllers\admincontroller@index');
            Route::get('register/{adminid}', 'App\Http\Controllers\admincontroller@create');
            Route::get('masteredit/{userid}', 'App\Http\Controllers\admincontroller@masteredit');
            Route::post('store', 'App\Http\Controllers\admincontroller@store')->name('admin.store');
            Route::post('masterupdate/{adminid}', 'App\Http\Controllers\admincontroller@masterupdate')->name('admins.masterupdate');
        });
        Route::group(['middleware' => 'admin'], function () {
            Route::get('edit/{userid}', 'App\Http\Controllers\admincontroller@edit');
            Route::post('update/{adminid}', 'App\Http\Controllers\admincontroller@update')->name('admins.update');
            Route::get('delete/{adminid}', 'App\Http\Controllers\admincontroller@destroy');
            Route::get('display', 'App\Http\Controllers\admincontroller@admindisplay');
            Route::get('adminhome', 'App\Http\Controllers\admincontroller@adminhome');
            Route::get('problems/{admin_id}', 'App\Http\Controllers\admincontroller@problemssolved')->name('admin.problems');
        });
        Route::get('adminlogin', 'App\Http\Controllers\admincontroller@adminlogin')->name('adminlogin')->middleware('auth');
        Route::post('dologin', 'App\Http\Controllers\admincontroller@dologin')->name('dologin')->middleware('auth');
    });
    Route::group(['prefix' => 'problem'], function () {
        Route::group(['middleware' => 'auth'], function () {
            Route::get('create', 'App\Http\Controllers\problemcontroller@create');
            Route::get('edit/{problemid}', 'App\Http\Controllers\problemcontroller@edit');
            Route::post('store', 'App\Http\Controllers\problemcontroller@store')->name('problem.store');
            Route::post('update/{problemid}', 'App\Http\Controllers\problemcontroller@update')->name('problems.update');
            Route::get('delete/{problemid}', 'App\Http\Controllers\problemcontroller@destroy');
        });
        Route::group(['middleware' => 'admin'], function () {
            Route::get('unsolved-problems', 'App\Http\Controllers\problemcontroller@unsolvedindex');
            Route::get('answer/{problemid}', 'App\Http\Controllers\problemcontroller@editwithanswer');
            Route::post('addanswer/{problemid}', 'App\Http\Controllers\problemcontroller@updatewithanswer')->name('problems.updatewithanswer');
        });
        Route::group(['middleware' => 'mainadmin'], function () {
            Route::get('problems', 'App\Http\Controllers\problemcontroller@index');
            Route::get('solved-problems', 'App\Http\Controllers\problemcontroller@solvedindex');
            Route::get('delete', 'App\Http\Controllers\problemcontroller@destroyall');
        });
    });
});
