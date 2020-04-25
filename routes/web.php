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

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/mahasiswa', function () {
//     return view('mahasiswa');
// });

// Route::get('/about', function () {
//     $nama = 'Kevin Maulaana Nasrullah';
//     return view('about', ['nama' => $nama]);
// });

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/mahasiswa', 'MahasiswaController@index');
Route::get('/students', 'StudentsController@index');
Route::get('/students/create', 'StudentsController@create');
Route::get('/students/{students}', 'StudentsController@show');

Route::get('/students/nilai/{students}', 'StudentsController@nilai');

Route::post('/students', 'StudentsController@store');
Route::update('/students', 'StudentsController@update');
