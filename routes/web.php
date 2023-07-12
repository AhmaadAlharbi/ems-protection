<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TakleefController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/takleef', [TakleefController::class, 'index'])->name('Takleef.index');
Route::get('/search/{month}', [TakleefController::class, 'takleefList']);
Route::resource('takleef', TakleefController::class);
Route::get('/takleef/show/{id}/{month}', [TakleefController::class, 'show'])->name('takleef.show');
Route::post('/takleef/search/{month}', [TakleefController::class, 'search'])->name('takleef.search');
Route::get('/edit-takleef/{id}/{month}', [TakleefController::class, 'edit'])->name('edit-takleef');
Route::resource('employees', EmployeeController::class);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';