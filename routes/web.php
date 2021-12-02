<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
})->name('index');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth',Auth::check()],function () {
    

Route::get('/farmer', function(){
    return view('farmer/index');
});

Route::get('/inputprovider', function(){
    return view('providers/index');
});

Route::get('/bank/investor', function(){
    return view('investors/index');
});

Route::get('/vendor', function(){
    return view('vendors/index');
});

});
