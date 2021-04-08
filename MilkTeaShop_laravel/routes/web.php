<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\DatabaseTestingController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ImageController;

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
// Testing

// Route::get('/greeting', function(){
//     return 'Greeting my friend!';
// });

/**
 * Dưới này là cách khai báo route để gọi đến 1 class Controller, tham biến thứ 2 là method của Controller đó
 */

Route::get('/register',[ClientController::class,'render_register_form']);
Route::post('/register',[ClientController::class,'register']);
Route::get('/login',[ClientController::class,'render_login_form']);
Route::post('/login',[ClientController::class,'login']);
Route::get('/',[DrinkController::class,'render']);
Route::get('/setup',[SetupController::class,'setup']);
// Drink Section
Route::get('/drink',[DrinkController::class,'render']);
Route::get('/drink/drinkform',[DrinkController::class,'render_form_insert']);
Route::get('/drink/drinkform/{drink_id}',[DrinkController::class,'render_form_update']);
Route::post('/drink/insert',[DrinkController::class,'insert']);
Route::post('/drink/update/{drink_id}',[DrinkController::class,'update']);
// ========================

// Extra Section
Route::get('/extra',[ExtraController::class,'render']);
Route::get('/extra/extraform',[ExtraController::class,'render_form']);
Route::get('/extra/extraform/{extra_id}',[ExtraController::class,'render_form']);
Route::post('/extra/insert',[ExtraController::class,'insert']);
Route::post('/extra/update/{extra_id}',[ExtraController::class,'insert']);
// ========================

// Order Section
// ========================

// Nofitication Section 
// ========================
// Route::get('/storage/img/{filename}',[ImageController::class,'display_image']);
Route::get('test',[DatabaseTestingController::class,'test']);
