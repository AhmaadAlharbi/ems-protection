<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
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
    // return view('welcome');
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/takleef', [TakleefController::class, 'index'])->name('Takleef.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/search/{month}', [TakleefController::class, 'takleefList']);
    Route::resource('takleef', TakleefController::class);
    Route::get('/takleef/show/{id}/{month}', [TakleefController::class, 'show'])->name('takleeef.show');
    Route::post('/takleef/search/{month}', [TakleefController::class, 'search'])->name('takleef.search');
    Route::get('/edit-takleef/{month}/{id}', [TakleefController::class, 'edit'])->name('edit-takleef');
    Route::resource('employees', EmployeeController::class);
    Route::get('/export/{month}', [TakleefController::class, 'exportToExcel'])->name('export');
});
Route::resource('/permission', PermissionController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
