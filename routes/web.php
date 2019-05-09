<?php

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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/', 'HomeController@index');


// Route::get('/', function () {
//     return view('layouts.base');
// });
Route::middleware('auth')->group(function() {
    Route::resource('lectures', 'LectureController');
    Route::resource('students', 'StudentController');
    Route::resource('grades', 'GradeController');
}
);
//Auth::routes();


