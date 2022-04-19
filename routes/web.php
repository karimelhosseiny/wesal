<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// // admin routes middleware group
// Route::middleware(['auth', 'admin'])->group(function () {
//    Route::get('/sergawyusers', [UserController::class, 'index']) ;

// });


// // organization routes miidleware group
// Route::middleware(['auth', 'organization'])->group(function () {
//      Route::get('/redausers', [OrganizationController::class, 'index']) ;

//  });



Route::resource('/users', UserController::class);
Route::resource('/organizations', OrganizationController::class);
Route::resource('api/cases', CaseController::class);
Route::resource('/reminders', ReminderController::class);

Route::get('api/userhomepage/{id}', [PagesController::class, 'userhomepage'])->where('id', '[0-9]+');
Route::get('api/orghomepage/{id}', [PagesController::class, 'orghomepage'])->where('id', '[0-9]+');
Route::get('api/casepage/{id}', [PagesController::class, 'casepage'])->where('id', '[0-9]+');
Route::get('api/userprofile/{id}', [PagesController::class, 'userprofile'])->where('id', '[0-9]+');
Route::get('api/cases', [PagesController::class, 'cases']);

Route::get('/testforms', [PagesController::class, 'testforms']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/isadmin', [PagesController::class, 'indexadmin']);
Route::get('/isorganization', [PagesController::class, 'indexorganization']);
Route::get('/isuser', [PagesController::class, 'indexuser']);


Route::resource('/admin', AdminController::class);
Route::get('api/retrieverequests', [AdminController::class, 'retrieverequests']);
Route::get('api/accepted/{id}', [AdminController::class, 'acceptrequest'])->where('id', '[0-9]+');
Route::get('api/rejected/{id}', [AdminController::class ,'rejectrequest'])->where('id', '[0-9]+');



//TODO: 1)handle the exceptions of the retrieved request in All Applications