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
use App\Http\Controllers;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrgController;
use App\Http\Controllers\AdminCaseController;
use App\Http\Controllers\AdminCateController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminDashBoardController;
use App\Http\Controllers\AuthController;


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
// Route::resource('/users', UserController::class);
Route::get('/testfavcase', [UserController::class, 'favcasepage']); //(just test from) to check storing nwe favourite case in database
//editprofile lluser test mara tanyia
Route::get('/testedit', [UserController::class, 'edittest']); //show user profile to edit it
Route::get('edittest', [UserController::class, 'edittest']);
Route::get('remindertest', [UserController::class, 'remindertest']); //show user's reminders
//--------------------------------------------------------------------------------------------------------------------------------------


//Organization controller
Route::get('/testorgforms', [OrganizationController::class, 'testorgforms']); // (just test from) to apply to be organization
Route::get('/orgaddcase', [OrganizationController::class, 'orgaddanycase']); //(just test from) to add new case by organization
Route::get('/orgupdatecase', [OrganizationController::class ,'orgupdateanycase']); //(just test from) to update new case by organization
Route::get('/orgdeletecase', [OrganizationController::class ,'orgdeleteanycase']); //(just test from) to add delete case by organization
Route::get('orgupdatecase', [OrganizationController::class ,'orgupdateitsprofile']); //(just test from) to add delete case by organization
//------------------------------------------------------------------------------------------------------------------------------------------------------------------


//Case Controller
//UserDoantion Test
Route::get('/userdonation', [CaseController::class, 'userdonate']); //just test from
//-----------------------------------------------------------------------------------------


//Reminder Controller
//---------------------------------------------------------------------------------------------------------------------------------------------------


//Pages Controller

// Route::get('/isadmin', [PagesController::class, 'indexadmin']);  //Gate authorization for admin
// Route::get('/isorganization', [PagesController::class, 'indexorganization']); //Gate authorization for organization
// Route::get('/isuser', [PagesController::class, 'indexuser']); //Gate authorization for user
//-----------------------------------------------------------------------------------------------------------------------------


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//----------------------------------------------------------------------------------------


// Admin Controller
// Route::resource('/admin', AdminController::class);
Route::get('/testadduser', [AdminController::class, 'testadduser']); //(just test form) to add user
Route::get('/testaddorg', [AdminController::class, 'testaddorg']); //(just test form) to add organization
Route::get('/edituserbyadmin', [AdminController::class, 'Adminupdateuser']); //(just test from) to edit user profile by admin
Route::get('/editorgbyadmin', [AdminController::class, 'Adminupdateorg']); //(just test from) to edit organization profile by admin
Route::get('/admindeleteuserwithtype', [AdminController::class, 'admindeleteanyuser']); //(just test form) to delete user and organization by admin
//------------------------------------------------------------------------------------------------------------------------------------


// AdminUserController
//------------------------------------------------------------------------------------------------------------------------------------


// AdminOrgController
//---------------------------------------------------------------------------------------------------------------------------------------------------


// AdminCaseController
Route::get('/adminaddcase' ,[AdminController::class, 'adminaddnewcase']); //(just test from) to add new case by admin
Route::get('/admindeletecase', [AdminController::class, 'admindeleteanycase']); //(just test form) to delete case by admin
Route::get('/adminupdatecase', [AdminController::class, 'adminupdateanycase']); //(just test from) to update case by admin
//------------------------------------------------------------------------------------------------------------------------------------


// AdminCateController
Route::get('/adminaddcategory' ,[AdminController::class, 'adminaddnewcategory']); //(just test from) to add new category by admin
Route::get('/admindeletecategory', [AdminController::class, 'admindeleteanycategory']); //(just test form) to delete category by admin
Route::get('/adminupdatecategory', [AdminController::class, 'adminupdateanycategory']); //(just test from) to update category by admin
//----------------------------------------------------------------------------------------------------------------------------------------------------


// Admin Dashboard
//----------------------------------------------------------------------------------------------------------------------------------------------


Auth::routes();
//authentication for all users to login and signup
Route::get('api/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('api/login', [LoginController::class, 'login']); //youssef
// Route::post('api/logout', [LoginController::class,'logout'])->name('logout');
// Registration Routes...
Route::get('api/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('api/register', [RegisterController::class, 'register']); //youssef
// Password Reset Routes...
Route::get('api/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
Route::post('api/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('api/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('api/password/reset', [ResetPasswordController::class, 'reset']);
//---------------------------------------------------------------------------------------------------