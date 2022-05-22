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


// AdminUserController
Route::post('api/adduser', [AdminUserController::class, 'addUserWithType'])->middleware(['auth:sanctum', 'is_admin']);  //store new user or organization or admin
Route::post('updatedone', [AdminUserController::class, 'adminupdateuserprofile'])->middleware(['auth:sanctum', 'is_admin']);   //store the new updates for the user profile
Route::post('userdeleted', [AdminUserController::class, 'adminDeleteUserByType'])->middleware(['auth:sanctum', 'is_admin']);   //delete user record from database

Route::get('retrieverequests', [AdminUserController::class, 'retrieverequests'])->middleware(['auth:sanctum', 'is_admin']); //admin retrieves requests
Route::post('accepted/{id}', [AdminUserController::class, 'acceptrequest'])->where('id', '[0-9]+')->middleware(['auth:sanctum', 'is_admin']); //admin accepts request
Route::post('api/rejected/{id}', [AdminUserController::class, 'rejectrequest'])->where('id', '[0-9]+')->middleware(['auth:sanctum', 'is_admin']); //admin rejects request





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


Route::post('/register', [AuthController::class ,'registeruser']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout', [AuthController::class ,'logout']);

//Route::post('/register','AuthController@register');
//Route::post('/login', [AuthController::class ,'loginuser']);



