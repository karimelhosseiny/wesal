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

Route::get('/showfavcase', [UserController::class, 'showfavcase']); //show user's favourite cases
Route::post('/createfavcase', [UserController::class, 'createfavcase']); //store new favourite case in database
Route::get('/testfavcase', [UserController::class, 'favcasepage']); //(just test from) to check storing nwe favourite case in database

Route::get('/remindertest', [UserController::class, 'remindertest']); //show user's reminders
Route::post('/setreminder', [UserController::class, 'setreminder']); //store new reminder in database
Route::get('api/edittest', [UserController::class, 'edittest']);  

Route::post('/deletefavcase', [UserController::class, 'deletefavcase']); //delete favourite case from database
Route::post('/deletereminder', [UserController::class, 'deletereminder']); //delete reminder from database
//editprofile lluser test mara tanyia 
Route::get('/testedit', [UserController::class, 'edittest']); //show user profile to edit it 
Route::post('/edituser', [UserController::class, 'editprofile']); //store the new updates of the user's profile
// Route::resource('/users', UserController::class);
//--------------------------------------------------------------------------------------------------------------------------------------


//Organization controller
Route::get('api/organizations', [OrganizationController::class, 'organizations']); // show all organizations form database
Route::resource('/organization', OrganizationController::class); //to use function show() in organization controller type: http://127.0.0.1:8000/organization/{id}
Route::get('/testorgforms', [OrganizationController::class, 'testorgforms']); // (just test from) to apply to be organization 
Route::post('/postorg', [OrganizationController::class, 'store']); //store the  organization requests in database

Route::get('/orgaddcase', [OrganizationController::class, 'orgaddanycase']); //(just test from) to add new case by organization
Route::post('/newcaseadded', [OrganizationController::class, 'orgAddCase']); //store new case in database
Route::get('/orgupdatecase', [OrganizationController::class ,'orgupdateanycase']); //(just test from) to update new case by organization
Route::post('/newcaseupdated',[OrganizationController::class, 'orgUpdateCase']); //store new updatesfor the case in database
Route::get('/orgeletecase', [OrganizationController::class ,'orgdeleteanycase']); //(just test from) to add delete case by organization
Route::post('/anycasedeleted',[OrganizationController::class, 'orgDeleteCase']); //delete case record from the database


Route::get('/orgupdatecase', [OrganizationController::class ,'orgupdateitsprofile']); //(just test from) to add delete case by organization
Route::post('/orgprofileupdated',[OrganizationController::class, 'orgUpdateProfile']); //delete case record from the database


//------------------------------------------------------------------------------------------------------------------------------------------------------------------


//Case Controller
Route::get('api/cases', [CaseController::class, 'cases']); // show all cases from database
//-----------------------------------------------------------------------------------------


//Reminder Controller
Route::resource('/reminders', ReminderController::class);//to use function show() in reminder controller type: http://127.0.0.1:8000/reminders/{id}
//---------------------------------------------------------------------------------------------------------------------------------------------------


//Pages Controller
Route::get('api/userhomepage/{id}', [PagesController::class, 'userhomepage'])->where('id', '[0-9]+'); //show user homepage
Route::get('api/orghomepage/{id}', [PagesController::class, 'orghomepage'])->where('id', '[0-9]+'); //show organization homepage
Route::get('api/casepage/{id}', [PagesController::class, 'casepage'])->where('id', '[0-9]+'); //show case page
Route::get('api/userprofile/{id}', [PagesController::class, 'userprofile'])->where('id', '[0-9]+'); //show user profile 

Route::get('/isadmin', [PagesController::class, 'indexadmin']);  //Gate authorization for admin
Route::get('/isorganization', [PagesController::class, 'indexorganization']); //Gate authorization for organization
Route::get('/isuser', [PagesController::class, 'indexuser']); //Gate authorization for user
//-----------------------------------------------------------------------------------------------------------------------------


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//----------------------------------------------------------------------------------------


// Admin Controller
Route::get('api/retrieverequests', [AdminUserController::class, 'retrieverequests']); //admin retrieves requests
Route::resource('/admin', AdminController::class);
Route::get('/testadduser', [AdminController::class, 'testadduser']); //(just test form) to add user
Route::get('/testaddorg', [AdminController::class, 'testaddorg']); //(just test form) to add organization
Route::get('/edituserbyadmin', [AdminController::class, 'Adminupdateuser']); //(just test from) to edit user profile by admin
Route::get('/editorgbyadmin', [AdminController::class, 'Adminupdateorg']); //(just test from) to edit organization profile by admin
Route::get('/admindeleteuserwithtype', [AdminController::class, 'admindeleteanyuser']); //(just test form) to delete user and organization by admin
//------------------------------------------------------------------------------------------------------------------------------------


// AdminUserController
Route::get('api/accepted/{id}', [AdminUserController::class, 'acceptrequest'])->where('id', '[0-9]+'); //admin accepts request
Route::get('api/rejected/{id}', [AdminUserController::class, 'rejectrequest'])->where('id', '[0-9]+'); //admin rejects request
Route::post('/userdeleted', [AdminUserController::class, 'adminDeleteUserByType']); //delete user record from database
Route::post('/adduser', [AdminUserController::class, 'addUserWithType']); //store new user or organization or admin
Route::post('/updatedone', [AdminUserController::class, 'adminupdateuserprofile']); //store the new updates for the user profile
//------------------------------------------------------------------------------------------------------------------------------------


// AdminOrgController
Route::post('/orgdeleted', [AdminOrgController::class, 'adminDeleteOrg']); //delete organization record from database
Route::post('/updateorgdone', [AdminOrgController::class, 'adminupdateorganizationprofile']); //store the new updates for the organization profile
//---------------------------------------------------------------------------------------------------------------------------------------------------


// AdminCaseController
Route::get('/adminaddcase' ,[AdminController::class, 'adminaddnewcase']); //(just test from) to add new case by admin
Route::post('/caseadded',[AdminCaseController::class, 'adminaddcase']); //store new case in database
Route::get('/admindeletecase', [AdminController::class, 'admindeleteanycase']); //(just test form) to delete case by admin
Route::post('/casedeleted', [AdminCaseController::class, 'admindeletecase']); //delete case record from database
Route::get('/adminupdatecase', [AdminController::class, 'adminupdateanycase']); //(just test from) to update case by admin
Route::post('/caseupdated', [AdminCaseController::class, 'adminupdatecase']); //store the new updates for the case
//------------------------------------------------------------------------------------------------------------------------------------


// AdminCateController
Route::get('/adminaddcategory' ,[AdminController::class, 'adminaddnewcategory']); //(just test from) to add new category by admin
Route::post('/categoryadded',[AdminCateController::class, 'adminaddcategory']); //store new category in database
Route::get('/admindeletecategory', [AdminController::class, 'admindeleteanycategory']); //(just test form) to delete category by admin
Route::post('/categorydeleted', [AdminCateController::class, 'admindeletecategory']); //delete category record from database
Route::get('/adminupdatecategory', [AdminController::class, 'adminupdateanycategory']); //(just test from) to update category by admin
Route::post('/categoryupdated', [AdminCateController::class, 'adminupdatecategory']); //store the new updates for the category
//----------------------------------------------------------------------------------------------------------------------------------------------------


// Admin Dashboard
Route::get('/userdashboard', [AdminDashBoardController::class , 'userDashBoard']);
Route::get('/catedashboard', [AdminDashBoardController::class , 'cateDashBoard']);
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



//TODO: 1)handle the exceptions of the retrieved request in All Applications