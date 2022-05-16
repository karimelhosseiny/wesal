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
//Route::post('/login', [AuthController::class ,'loginuser']);
Route::post('/logout', [AuthController::class ,'logoutuser']);



