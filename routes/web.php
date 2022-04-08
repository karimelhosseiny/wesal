<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReminderController;
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

// admin routes middleware group
Route::middleware(['auth', 'admin'])->group(function () {
   Route::get('/sergawyusers', [UserController::class, 'index']) ;

});


// organization routes miidleware group
Route::middleware(['auth', 'organization'])->group(function () {
    Route::get('/redausers', [OrganizationController::class, 'index']) ;
 
 });
 


Route::resource('/users', UserController::class);
Route::resource('/organizations', OrganizationController::class);
Route::resource('/cases', CaseController::class);
Route::resource('/reminders', ReminderController::class);

Route::get('/userhomepage/{id}', [PagesController::class, 'userhomepage'])->where('id', '[0-9]+');
Route::get('/orghomepage/{id}', [PagesController::class, 'orghomepage'])->where('id', '[0-9]+');
Route::get('/casepage/{id}', [PagesController::class, 'casepage'])->where('id', '[0-9]+');
Route::get('/userprofile/{id}', [PagesController::class, 'userprofile'])->where('id', '[0-9]+');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


