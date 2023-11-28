<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;


Route::get('/', function () {

    return redirect()->route('login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('roles',RoleController::class);
Route::resource('permissions',PermissionController::class);

// Route::resource('business-profiles',BusinessProfileController::class);
// Route::get('/business-profiles-list',    [BusinessProfileController::class, 'getData']);

Route::get('/business-profiles',    [BusinessProfileController::class, 'index'])->name('business-profiles.index');

Route::get('/business-profiles-list', [BusinessProfileController::class, 'getData'])->name('business-profiles.list');

Route::get('/business-profiles-create', [BusinessProfileController::class, 'create'])->name('business-profiles.create');

Route::post('/business-profiles-store', [BusinessProfileController::class, 'store'])->name('business-profiles.store');

Route::get('/business-profiles-edit/{id}', [BusinessProfileController::class, 'edit'])->name('business-profiles.edit');

Route::put('/business-profiles-update/{id}', [BusinessProfileController::class, 'update'])->name('business-profiles.update');

Route::get('/business-profiles-delete/{id}', [BusinessProfileController::class,'destroy'])->name('business-profiles.destroy');

Route::get('/business-profiles-export', [BusinessProfileController::class, 'export'])->name('business-profiles.export');

Route::get('/users-detail',    [UserController::class, 'detail'])->name('users.detail');

Route::post('/users-update',    [UserController::class, 'updateUser'])->name('users.update');
