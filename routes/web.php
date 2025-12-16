<?php


use Illuminate\Support\Facades\Route;
use Laraveldaily\LaravelPermissionEditor\Http\Controllers\RoleController;
use Laraveldaily\LaravelPermissionEditor\Http\Controllers\PermissionController;

Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);