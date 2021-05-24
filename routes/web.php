<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorsController;

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

Route::group(['prefix' => '{locale}'], function() {
    config(['app.locale' => Request::segment(1)]);
    Route::resource('authors', AuthorsController::class);
});
