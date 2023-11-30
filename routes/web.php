<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;


Route::get('/', function () {

    return redirect()->route('login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::resource('roles',RoleController::class);
// Route::resource('permissions',PermissionController::class);



Route::group(['middleware' => ['role:admin']], function () {

    // =======================
    //   Roles
    // =======================


    Route::get('/roles',    [RoleController::class, 'index'])->name('roles.index');

    Route::get('/roles-list',    [RoleController::class, 'getRoleData'])->name('roles.list');

    Route::get('/roles-show/{id}',    [RoleController::class, 'show'])->name('roles.show');

    Route::get('/roles-create', [RoleController::class, 'create'])->name('roles.create');

    Route::post('/roles-store', [RoleController::class, 'store'])->name('roles.store');

    Route::get('/roles-edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');

    Route::put('/roles-update/{id}', [RoleController::class, 'update'])->name('roles.update');

    Route::get('/roles-delete/{id}', [RoleController::class,'destroy'])->name('roles.destroy');



    // =======================
    //   Permissions
    // =======================


    Route::get('/permissions',    [PermissionController::class, 'index'])->name('permissions.index');

    Route::get('/permissions-list',    [PermissionController::class, 'getPermissionData'])->name('permissions.list');

    Route::get('/permissions-create', [PermissionController::class, 'create'])->name('permissions.create');

    Route::post('/permissions-store', [PermissionController::class, 'store'])->name('permissions.store');

    Route::get('/permissions-edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');

    Route::put('/permissions-update/{id}', [PermissionController::class, 'update'])->name('permissions.update');

    Route::get('/permissions-delete/{id}', [PermissionController::class,'destroy'])->name('permissions.destroy');




    // =======================
    //   Users
    // =======================

    Route::get('/users',    [UserController::class, 'index'])->name('users.index');

    Route::get('/users-list',    [UserController::class, 'getUserData'])->name('users.list');

    Route::get('/users-details/{id}',    [UserController::class, 'details'])->name('users.details');

    Route::get('/users-edit/{id}',    [UserController::class, 'edit'])->name('users.edit');

    Route::post('/users-update',    [UserController::class, 'update'])->name('users.update');

    Route::get('/users-profile',    [UserController::class, 'profilePage'])->name('users.profile');

    Route::post('/users-profile',    [UserController::class, 'updateUserProfile'])->name('users-profile.update');





    // =======================
    // Business Profiles
    // =======================

    Route::get('/business-profiles',    [BusinessProfileController::class, 'index'])->name('business-profiles.index');

    Route::get('/business-profiles-list', [BusinessProfileController::class, 'getData'])->name('business-profiles.list');

    Route::get('/business-profiles-create', [BusinessProfileController::class, 'create'])->name('business-profiles.create');

    Route::post('/business-profiles-store', [BusinessProfileController::class, 'store'])->name('business-profiles.store');

    Route::get('/business-profiles-edit/{id}', [BusinessProfileController::class, 'edit'])->name('business-profiles.edit');

    Route::put('/business-profiles-update/{id}', [BusinessProfileController::class, 'update'])->name('business-profiles.update');

    Route::get('/business-profiles-delete/{id}', [BusinessProfileController::class,'destroy'])->name('business-profiles.destroy');

    Route::get('/business-profiles-export', [BusinessProfileController::class, 'export'])->name('business-profiles.export');

    Route::post('/business-profiles-import', [BusinessProfileController::class, 'import'])->name('business-profiles.import');


    // =======================
    // Blogs
    // =======================

    Route::get('/blogs',    [BlogController::class, 'index'])->name('blogs.index');

    Route::get('/blogs-list', [BlogController::class, 'getData'])->name('blogs.list');

    Route::get('/blogs-create', [BlogController::class, 'create'])->name('blogs.create');

    Route::post('/blogs-store', [BlogController::class, 'store'])->name('blogs.store');

    Route::get('/blogs-edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');

    Route::put('/blogs-update/{id}', [BlogController::class, 'update'])->name('blogs.update');

    Route::get('/blogs-delete/{id}', [BlogController::class,'destroy'])->name('blogs.destroy');

});


// ==============
// Editor
// ==============

Route::group(['middleware' => ['role:editor']], function () {


    // =======================
    // Blogs
    // =======================

    Route::get('/blogs',    [BlogController::class, 'index'])->name('blogs.index');

    Route::get('/blogs-list', [BlogController::class, 'getData'])->name('blogs.list');

    Route::get('/blogs-create', [BlogController::class, 'create'])->name('blogs.create');

    Route::post('/blogs-store', [BlogController::class, 'store'])->name('blogs.store');

    Route::get('/blogs-edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');

    Route::put('/blogs-update/{id}', [BlogController::class, 'update'])->name('blogs.update');

    Route::get('/blogs-delete/{id}', [BlogController::class,'destroy'])->name('blogs.destroy');

});