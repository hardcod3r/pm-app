<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProjectController;


Route::post('login', AuthController::class);
Route::get('countries', CountryController::class)->middleware('auth:sanctum');
Route::resource('users', UserController::class)->middleware('auth:sanctum');
Route::resource('companies', CompanyController::class)->middleware('auth:sanctum');
Route::resource('projects', ProjectController::class)->middleware('auth:sanctum');

Route::post('companies/{company}/users/{user}', [CompanyController::class, 'attachUser'])->name(
    'companies.attachUser'
)->middleware('auth:sanctum');
Route::post('projects/{project}/companies/{company}', [ProjectController::class, 'associateProjectToCompany'])->name(
    'projects.assignProjectToCompany'
)->middleware('auth:sanctum');