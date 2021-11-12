<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;

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

/***********************************************************************************************************************
 *                                              Rutas Protegidas                                                       *
 ***********************************************************************************************************************/

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('companies', CompanyController::class);
    Route::post('companies/{company}', [CompanyController::class, 'restore'])->name('companies.restore');

    Route::resource('users', UserController::class);
    Route::post('users/{user}', [UserController::class, 'restore'])->name('users.restore');

});


/***********************************************************************************************************************
 *                                              Rutas Públicas                                                         *
 ***********************************************************************************************************************/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);
