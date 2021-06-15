<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\PuplishersController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\client\CBooksController;
use App\Http\Controllers\client\CRequestsController;
use App\Http\Controllers\RequestsController;

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
Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');
Route::group(['middleware' => ['locale', 'isadmin', ], 'prefix' => 'admin'], function() {
    Route::get('/', function () {

        return view('admin.home');
    });
    Route::resource('authors', AuthorsController::class);
    Route::resource('books', BooksController::class);
    Route::resource('puplishers', PuplishersController::class);
    Route::resource('statuses', StatusesController::class);
    Route::resource('requests', RequestsController::class)->only('destroy');
    Route::get('accept/{id}', [RequestsController::class, 'accept'])->name('accept.request');
    Route::get('all/accepted={isApprove}', [RequestsController::class, 'all'])->name('requests.all');
    Route::get('request/{id}', [RequestsController::class, 'showone'])->name('requests.showone');
});

Route::group(['middleware' => ['locale', 'isuser', ]], function() {
    Route::get('request/create/{book}', [CRequestsController::class, 'create'])->name('request.create');
    Route::post('request/store', [CRequestsController::class, 'store'])->name('request.store');
    Route::get('request/{id}', [CRequestsController::class, 'showone'])->name('request.showone');
});
Route::group(['middleware' => 'locale'], function() {
    Route::get('all-books/{category}', [CBooksController::class, 'index'])->name('client.books');
    Route::get('all-books', [CBooksController::class, 'index'])->name('client.books');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('notification', [NotificationsController::class, 'read'])->name('notifications.read');
