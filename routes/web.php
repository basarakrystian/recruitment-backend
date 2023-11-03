<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', 'App\Http\Controllers\AuthController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::get('/register', 'App\Http\Controllers\AuthController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::get('/books', 'App\Http\Controllers\BookController@index')->name('books.index');
Route::get('/', 'App\Http\Controllers\BookController@index')->name('index');

Route::resource('books', BookController::class)->except(['index'])->middleware(['auth:sanctum']);
