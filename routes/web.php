<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\http\Controllers\Auth\ResetPasswordController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//----------------------------------------------------------------------------------------
// Admin Controller
Route::get('api/retrieverequests', [AdminController::class, 'retrieverequests']); //admin retrieves requests
Route::get('api/accepted/{id}', [AdminController::class, 'acceptrequest'])->where('id', '[0-9]+'); //admin accepts request
Route::get('api/rejected/{id}', [AdminController::class, 'rejectrequest'])->where('id', '[0-9]+'); //admin rejects request
Route::resource('/admin', AdminController::class);
//----------------------------------------------------------------------------
//SHOWFAVCASE TEST
Route::get('/showfavcase', [UserController::class, 'showfavcase']);
Route::post('/createfavcase', [UserController::class, 'createfavcase']);
Route::get('/testfavcase', [UserController::class, 'favcasepage']);
//reminder test
Route::get('/remindertest', [UserController::class, 'remindertest']);
Route::post('/setreminder', [UserController::class, 'setreminder']);
//delete favcase
Route::post('/deletefavcase', [UserController::class, 'deletefavcase']);
//delete reminder
Route::post('/deletereminder', [UserController::class, 'deletereminder']);
Route::get('api/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('api/login', [LoginController::class, 'login']); //youssef
Route::post('api/logout', [LoginController::class,'logout'])->name('logout');
// Registration Routes...
Route::get('api/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('api/register', [RegisterController::class, 'register']); //youssef
// Password Reset Routes...
Route::get('api/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
Route::post('api/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('api/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('api/password/reset', [ResetPasswordController::class, 'reset']);

//add user by admin test
Route::get('/testadduser', [AdminController::class, 'testadduser']);
Route::get('/testaddorg', [AdminController::class, 'testaddorg']);

Route::post('/adduser', [AdminController::class, 'addUserWithType']);
//TODO: 1)handle the exceptions of the retrieved request in All Applications
