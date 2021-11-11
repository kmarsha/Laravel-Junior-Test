<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/admin', function() {
        return view('home');
    })->name('dashboard');
    Route::resource('company', CompanyController::class)->except('index');
    Route::resource('employee', EmployeeController::class)->except('index');
});

Route::middleware('auth')->group(function() {
    Route::get('company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

