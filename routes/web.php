<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DrugController;

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

Auth::routes();

// applicant router
Route::middleware(['auth', 'user-access:applicant'])->group(function () {
  
    Route::get('/applicant/home', [HomeController::class, 'applicant'])->name('applicant.index');
    Route::get('/applicant/register/drugs', [DrugController::class, 'create'])->name('applicant.drugs_registration');
    Route::post('/applicant/register/drugs/store', [DrugController::class, 'store'])->name('applicant.drugs.store');
});

// reviewer router
Route::middleware(['auth', 'user-access:reviewer'])->group(function () {
  
    Route::get('/reviewer/home', [HomeController::class, 'reviewer'])->name('reviewer.index');
    Route::get('/reviewer/registration/review', [DrugController::class, 'review'])->name('reviewer.review_registration');
    Route::get('/reviewer/registration/edit/{id}', [DrugController::class, 'edit'])->name('reviewer.edit');
    Route::put('/reviewer/registration/update/{id}', [DrugController::class, 'update'])->name('reviewer.update');
}); 

//router of queue
Route::get('drug-queue-validation', [DrugValidationController::class,'DrugValidation']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
