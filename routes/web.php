<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\BusinessProfileController;
use Illuminate\Support\Facades\Session;


Route::get('/', function () {

    return redirect()->route('login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('roles',RoleController::class);
Route::resource('permissions',PermissionController::class);

Route::resource('business-profiles',BusinessProfileController::class);
Route::get('/business-profiles-list',    [BusinessProfileController::class, 'getData']);
Route::get('/export', [BusinessProfileController::class, 'export']);



