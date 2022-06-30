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
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth Controller
Route::post('/register', [AuthController::class ,'registeruser']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout', [AuthController::class ,'logout']);
//------------------------------------------------------------------

// AdminUserController
Route::post('adduser', [AdminUserController::class, 'adminAddUserWithType'])->middleware(['auth:sanctum', 'is_admin']);  //store new user or organization or admin
Route::post('updatedone', [AdminUserController::class, 'adminUpdateUserWithType'])->middleware(['auth:sanctum', 'is_admin']);   //store the new updates for the user profile
Route::post('userdeleted', [AdminUserController::class, 'adminDeleteUserByType'])->middleware(['auth:sanctum', 'is_admin']);   //delete user record from database

Route::get('retrieverequests', [AdminUserController::class, 'retrieverequests'])->middleware(['auth:sanctum', 'is_admin']); //admin retrieves requests
Route::post('accepted/{id}', [AdminUserController::class, 'acceptrequest'])->where('id', '[0-9]+')->middleware(['auth:sanctum', 'is_admin']); //admin accepts request
Route::post('api/rejected/{id}', [AdminUserController::class, 'rejectrequest'])->where('id', '[0-9]+')->middleware(['auth:sanctum', 'is_admin']); //admin rejects request
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// AdminOrgController
Route::post('updateorgdone', [AdminOrgController::class, 'adminupdateorganizationprofile'])->middleware(['auth:sanctum', 'is_admin']); //store the new updates for the organization profile
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// AdminCaseController
Route::post('caseadded',[AdminCaseController::class, 'adminaddcase'])->middleware(['auth:sanctum', 'is_admin']); //store new case in database
Route::post('caseupdated', [AdminCaseController::class, 'adminupdatecase'])->middleware(['auth:sanctum', 'is_admin']); //store the new updates for the case
Route::post('casedeleted', [AdminCaseController::class, 'admindeletecase'])->middleware(['auth:sanctum', 'is_admin']); //delete case record from database
//-----------------------------------------------------------------------------------------------------------------------------------------------------------

// AdminCateController
Route::post('categoryadded',[AdminCateController::class, 'adminaddcategory'])->middleware(['auth:sanctum', 'is_admin']); //store new category in database
Route::post('categoryupdated', [AdminCateController::class, 'adminupdatecategory'])->middleware(['auth:sanctum', 'is_admin']); //store the new updates for the category
Route::post('categorydeleted', [AdminCateController::class, 'admindeletecategory'])->middleware(['auth:sanctum', 'is_admin']); //delete category record from database
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

// AdminDashBoardController
Route::get('userdashboard', [AdminDashBoardController::class , 'userDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('catedashboard', [AdminDashBoardController::class , 'cateDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('orgdashboard', [AdminDashBoardController::class , 'orgDashBoard'])/*->middleware(['auth:sanctum', 'is_admin'])*/;
Route::get('remindersdashboard', [AdminDashBoardController::class , 'remindersDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('donationsdashboard', [AdminDashBoardController::class , 'donationsDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('favcasedashboard', [AdminDashBoardController::class , 'favCaseDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
//------------------------------------------------------------------------------------------------------------------------------------

// Organization Controller
Route::get('organizations', [OrganizationController::class, 'organizations']); // show all organizations form database
Route::resource('organization', OrganizationController::class)->middleware(['auth:sanctum', 'is_organization']); //to use function show() in organization controller type: http://127.0.0.1:8000/organization/{id}
Route::post('postorg', [OrganizationController::class, 'store']); //store the  organization requests in database

Route::post('newcaseadded', [OrganizationController::class, 'orgAddCase'])->middleware(['auth:sanctum', 'is_organization']); //store new case in database
Route::post('newcaseupdated',[OrganizationController::class, 'orgUpdateCase'])->middleware(['auth:sanctum', 'is_organization']); //store new updatesfor the case in database
Route::post('anycasedeleted',[OrganizationController::class, 'orgDeleteCase'])->middleware(['auth:sanctum', 'is_organization']); //delete case record from the database

Route::post('orgprofileupdated',[OrganizationController::class, 'orgUpdateProfile'])->middleware(['auth:sanctum', 'is_organization']); //delete case record from the database
Route::get('orgdata',[OrganizationController::class, 'orgData']); //show all organizations' data
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Case Controller
Route::get('cases', [CaseController::class, 'cases']); // show all cases from database
Route::post('donationdone',[CaseController::class,'userdonation'])->middleware(['auth:sanctum']); //store user donation in database
//-----------------------------------------------------------------------------------------------------

// Reminder Controller
Route::resource('reminders', ReminderController::class);//to use function show() in reminder controller type: http://127.0.0.1:8000/reminders/{id}
//-------------------------------------------------------------------------------------------------------------------------------------------------

// User Controller 
Route::get('allusers', [UserController::class, 'index']); // show all users+admins
Route::get('admins', [UserController::class, 'usersadmins']); // show all users admins
Route::get('users', [UserController::class, 'usersnotadmins']); // show all users  without admins

Route::get('showfavcase', [UserController::class, 'showfavcase']); //show user's favourite cases
Route::post('createfavcase', [UserController::class, 'createfavcase'])->middleware(['auth:sanctum', 'is_user']); //store new favourite case in database

Route::post('setreminder', [UserController::class, 'setreminder'])->middleware(['auth:sanctum', 'is_user']); //store new reminder in database
Route::get('getreminder', [UserController::class, 'getreminder'])->middleware(['auth:sanctum','is_user']); //get user's reminders
Route::post('deletefavcase', [UserController::class, 'deletefavcase'])->middleware(['auth:sanctum', 'is_user']); //delete favourite case from database
Route::post('deletereminder', [UserController::class, 'deletereminder'])->middleware(['auth:sanctum', 'is_user']); //delete reminder from database

Route::post('edituser', [UserController::class, 'editprofile']); //store the new updates of the user's profile
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Pages Controller
Route::get('userhomepage/{id}', [PagesController::class, 'userhomepage'])->where('id', '[0-9]+'); //show user homepage
Route::get('orghomepage/{id}', [PagesController::class, 'orghomepage'])->where('id', '[0-9]+'); //show organization homepage
Route::get('casepage/{id}', [PagesController::class, 'casepage'])->where('id', '[0-9]+'); //show case page
Route::get('userprofile/{id}', [PagesController::class, 'userprofile'])->where('id', '[0-9]+')->middleware(['auth:sanctum', 'is_user']); //show user profile
//-----------------------------------------------------------------------------------------------------------------------------------------------------------