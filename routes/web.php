<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\PuplishersController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\LanguageController;

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

Route::group(['middleware' => 'locale'], function() {
    Route::resource('authors', AuthorsController::class);
    Route::resource('puplishers', PuplishersController::class);
    Route::resource('statuses', StatusesController::class);
    Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');
});
