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

Route::get('/', 'PagesController@home')->middleware('CheckLogin');

Route::get('/maps', 'MapsController@index')->middleware('CheckLogin');

Route::get('/auth/login', 'AuthsController@login');
Route::get('/auth/register', 'AuthsController@register');


Route::get('/about', 'PagesController@about');
Route::get('/mahasiswa', 'MahasiswaController@index');
Route::get('/students', 'StudentsController@index');
Route::get('/students/create', 'StudentsController@create');


//get page image students
Route::get('/students/image', 'StudentsController@image');


Route::get('/students/{students}', 'StudentsController@show');



Route::post('/students/image/create', 'StudentsController@postimage');


Route::get('/students/myprofile/{students}', 'StudentsController@update');

Route::get('/students/nilai/{students}', 'StudentsController@nilai');

Route::post('/auth/login', 'AuthsController@loginpost');
Route::post('/auth/register', 'AuthsController@registerpost');
Route::get('/verify', 'AuthsController@verify');

Route::post('/students', 'StudentsController@store');
Route::patch('/students/update/{students}', 'StudentsController@updatedata');
