<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminUserController;

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

// AdminUserController
Route::post('adduser', [AdminUserController::class, 'adminAddUserWithType'])->middleware(['auth:sanctum', 'is_admin']);  //store new user or organization or admin
Route::post('updatedone', [AdminUserController::class, 'adminUpdateUserWithType'])->middleware(['auth:sanctum', 'is_admin']);   //store the new updates for the user profile
Route::post('userdeleted', [AdminUserController::class, 'adminDeleteUserByType'])->middleware(['auth:sanctum', 'is_admin']);   //delete user record from database

Route::get('retrieverequests', [AdminUserController::class, 'retrieverequests'])->middleware(['auth:sanctum', 'is_admin']); //admin retrieves requests
Route::post('accepted/{id}', [AdminUserController::class, 'acceptrequest'])->where('id', '[0-9]+')->middleware(['auth:sanctum', 'is_admin']); //admin accepts request
Route::post('api/rejected/{id}', [AdminUserController::class, 'rejectrequest'])->where('id', '[0-9]+')->middleware(['auth:sanctum', 'is_admin']); //admin rejects request

// AdminOrgController
Route::post('updateorgdone', [AdminOrgController::class, 'adminupdateorganizationprofile'])->middleware(['auth:sanctum', 'is_admin']); //store the new updates for the organization profile

//AdminCaseController
Route::post('caseadded',[AdminCaseController::class, 'adminaddcase'])->middleware(['auth:sanctum', 'is_admin']); //store new case in database
Route::post('caseupdated', [AdminCaseController::class, 'adminupdatecase'])->middleware(['auth:sanctum', 'is_admin']); //store the new updates for the case
Route::post('casedeleted', [AdminCaseController::class, 'admindeletecase'])->middleware(['auth:sanctum', 'is_admin']); //delete case record from database

//AdminCateController
Route::post('categoryadded',[AdminCateController::class, 'adminaddcategory'])->middleware(['auth:sanctum', 'is_admin']); //store new category in database
Route::post('categoryupdated', [AdminCateController::class, 'adminupdatecategory'])->middleware(['auth:sanctum', 'is_admin']); //store the new updates for the category
Route::post('categorydeleted', [AdminCateController::class, 'admindeletecategory'])->middleware(['auth:sanctum', 'is_admin']); //delete category record from database

//AdminDashBoardController
Route::get('api/userdashboard', [AdminDashBoardController::class , 'userDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('/catedashboard', [AdminDashBoardController::class , 'cateDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('/orgdashboard', [AdminDashBoardController::class , 'orgDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('/remindersdashboard', [AdminDashBoardController::class , 'remindersDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('/donationsdashboard', [AdminDashBoardController::class , 'donationsDashBoard'])->middleware(['auth:sanctum', 'is_admin']);
Route::get('/favcasedashboard', [AdminDashBoardController::class , 'favCaseDashBoard'])->middleware(['auth:sanctum', 'is_admin']);










// Route::resource('/users', UserController::class);
// Route::resource('/organizations', OrganizationController::class);
// Route::resource('/cases', CaseController::class);
// Route::resource('/reminders', ReminderController::class);

// Route::get('/userhomepage/{id}', [PagesController::class, 'userhomepage'])->where('id', '[0-9]+');
// Route::get('/orghomepage/{id}', [PagesController::class, 'orghomepage'])->where('id', '[0-9]+');
// Route::get('/casepage/{id}', [PagesController::class, 'casepage'])->where('id', '[0-9]+');
// Route::get('/userprofile/{id}', [PagesController::class, 'userprofile'])->where('id', '[0-9]+');
// Route::get('/cases', [PagesController::class, 'cases']);



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/isadmin', [PagesController::class, 'indexadmin']);
// Route::get('/isorganization', [PagesController::class, 'indexorganization']);
// Route::get('/isuser', [PagesController::class, 'indexuser']);




//Route::post('/register','AuthController@register');
//Route::post('/login', [AuthController::class ,'loginuser']);



