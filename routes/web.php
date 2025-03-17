<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


// Auth routes
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.do');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Car routes
Route::middleware('auth')->group(function () {
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars/create/step1', [CarController::class, 'storeStep1'])->name('cars.store.step1');
    Route::get('/cars/create/step2', [CarController::class, 'createStep2'])->name('cars.create.step2');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');

    Route::get('/my-cars', [CarController::class, 'myCars'])->name('cars.my');
});

require __DIR__.'/auth.php';
