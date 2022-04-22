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


//User Controller
Route::get('api/allusers', [UserController::class, 'index']); // show all users+admins
Route::get('api/admins', [UserController::class, 'usersadmins']); // show all users admins
Route::get('api/users', [UserController::class, 'usersnotadmins']); // show all users  without admins
// Route::resource('/users', UserController::class);
//-----------------------------------------------------------------------------------------------------


//Organization controller
Route::get('api/organizations', [OrganizationController::class, 'organizations']); // show all organizations form database
Route::resource('/organization', OrganizationController::class); //to use function show() in organization controller type: http://127.0.0.1:8000/organization/{id}
//-------------------------------------------------------------------------------------------------------------------------


//Case Controller
Route::get('api/cases', [CaseController::class, 'cases']); // show all cases from database
//-----------------------------------------------------------------------------------------


//Reminder Controller
Route::resource('/reminders', ReminderController::class);
//-------------------------------------------------------


//Pages Controller
Route::get('api/userhomepage/{id}', [PagesController::class, 'userhomepage'])->where('id', '[0-9]+');
Route::get('api/orghomepage/{id}', [PagesController::class, 'orghomepage'])->where('id', '[0-9]+');
Route::get('api/casepage/{id}', [PagesController::class, 'casepage'])->where('id', '[0-9]+');
Route::get('api/userprofile/{id}', [PagesController::class, 'userprofile'])->where('id', '[0-9]+');

Route::get('api/edittest', [UserController::class, 'edittest']);
Route::get('/testforms', [PagesController::class, 'testforms']);

Route::get('/isadmin', [PagesController::class, 'indexadmin']);
Route::get('/isorganization', [PagesController::class, 'indexorganization']);
Route::get('/isuser', [PagesController::class, 'indexuser']);
//----------------------------------------------------------------------------------------------------


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//----------------------------------------------------------------------------------------


// Admin Controller
Route::get('api/retrieverequests', [AdminController::class, 'retrieverequests']); //admin retrieves requests
Route::get('api/accepted/{id}', [AdminController::class, 'acceptrequest'])->where('id', '[0-9]+'); //admin accepts request
Route::get('api/rejected/{id}', [AdminController::class ,'rejectrequest'])->where('id', '[0-9]+'); //admin rejects request
Route::resource('/admin', AdminController::class);
//----------------------------------------------------------------------------



//TODO: 1)handle the exceptions of the retrieved request in All Applications
