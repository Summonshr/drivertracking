<?php

use App\Models\Driver;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::middleware('not-in-break')->group(function () {
        Route::resource('resource', 'ResourceController');
        Route::view('punch-in', 'form.index')->name('main');
    });
    Route::get('break', 'AuthController@break');
    Route::view('/is-in-break', 'break');
});

Route::get('/', function(){
    $driver = new Driver();
    $driver->name = 'woring';
    $driver->save();
});

Route::prefix('admin')->group(function () {
    Route::get('logout', 'AuthController@logout')->name('admin.logout');
    Route::view('login', 'admin.login')->name('admin.login');
    Route::post('login', 'AuthController@adminLogin')->name('admin.login.post');

    Route::middleware(['admin', 'data-wrapper'])->group(function () {
        Route::view('/', 'dashboard.index')->name('admin.dashboard');
        Route::resource('resource', 'ResourceController');
        Route::view('/search', 'search.index')->name('admin.search');
        Route::get('/{resource_type}/{resource_action?}/{resource?}', 'ResourceController@view')->name('resource.view');
    });
});

Route::post('/file/upload/{resource_type}/{resource?}', 'MediaController@upload')->name('upload');
Route::post('punch-in', 'AuthController@punchIn')->name('punch-in');

// Route::view('/','Pin.index');
Route::view('/login', 'pin.index')->name('login');
Route::get('/table/{table}', function ($table) {
    return \DB::table(\Str::plural($table))->get();
});

