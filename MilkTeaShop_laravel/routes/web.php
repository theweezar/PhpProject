<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\DatabaseTestingController;

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
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/greeting', function(){
//     return 'Greeting my friend!';
// });

/**
 * Dưới này là cách khai báo route để gọi đến 1 class Controller, tham biến thứ 2 là method của Controller đó
 */

Route::get('/register',[ClientController::class,'register']);
Route::get('/drink',[DrinkController::class,'render']);
Route::get('/drink/drinkform',[DrinkController::class,'render_form']);
Route::get('test',[DatabaseTestingController::class,'test']);
// Route::post('/drink/insert',[DrinkController::class,'insert']);
