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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/test', 'HomeController@test');

Route::get('/test/{subject}', 'HomeController@getExam');

Route::post('/get-mark', 'HomeController@getMark');

Route::get('/manage/login','Manage\AuthController@showLoginForm');
Route::post('/manage/login','Manage\AuthController@login')->name('manage-login');
Route::post('/manage/logout','Manage\AuthController@logout')->name('manage-logout');

Route::get('/user/update', 'HomeController@updateLayout')->name('update-user');
Route::post('/user/update', 'HomeController@updateUser')->name('updated');

Route::group(['prefix'=> 'manage', 'middleware' => 'admin'], function () {
    Route::get('/','Manage\AuthController@index')->name('manage');
    Route::get('/upload-exam','AdminController@layoutUploadExam')->name('upload-exam');
    Route::post('/upload-exams','AdminController@import')->name('post-exam');

    Route::get('/exam', 'AdminController@ShowExam')->name('list-exam');

    Route::get('/result', 'AdminController@ShowResult')->name('list-result');

    Route::post('/upload-result', 'AdminController@uploadResult')->name('post-result');

    Route::get('/hoc-vien', 'AdminController@showUser')->name('hoc-vien');

    Route::get('/upload-img', 'AdminController@ShowUploadImg')->name('upload-img');

    Route::post('/upload-img', 'AdminController@uploadImg')->name('post-img');
});
