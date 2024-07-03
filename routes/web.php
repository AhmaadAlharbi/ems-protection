<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TakleefController;
use App\Models\Takleef;
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
    return view('employees.index');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/takleef', [TakleefController::class, 'index'])->name('Takleef.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/search/{month}', [TakleefController::class, 'takleefList']);
    Route::resource('takleef', TakleefController::class);
    Route::get('/takleef/show/{id}/{month}/{year}', [TakleefController::class, 'show'])->name('takleeef.show');

    Route::get('/takleef/pdf/{id}/{month}/{year}', [TakleefController::class, 'generatePDF'])->name('generate-pdf');
    Route::post('/takleef/search/{month}/{year}', [TakleefController::class, 'search'])->name('takleef.search');
    Route::get('/edit-takleef/{month}/{id}/{year}', [TakleefController::class, 'edit'])->name('edit-takleef');
    Route::get('/add-single-takleef/{id}/{month}/{year}', [TakleefController::class, 'singleTakleef'])->name('singleTakleef');
    Route::post('/add-single-takleef', [TakleefController::class, 'storeSingleTakleef'])->name('storeSingleTakleef');
    Route::resource('employees', EmployeeController::class);
    Route::get('/export/{month}', [TakleefController::class, 'exportToExcel'])->name('export');
    Route::resource('holidays', HolidayController::class);
});
Route::resource('/permission', PermissionController::class);
Route::get('/permission/{permission_id}/showPdf', [PermissionController::class, 'showPermissionPdf'])->name('showPermissionPdf');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
