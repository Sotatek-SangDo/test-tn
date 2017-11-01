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

Route::get('/list-test', 'HomeController@index')->name('exams');

Route::get('/test', 'HomeController@test');

Route::get('/test/{subject}', 'HomeController@getExam');

Route::get('/result/{subject}', 'HomeController@getResultTest');

Route::post('/get-mark', 'HomeController@getMark');

Route::get('/manage/login','Manage\AuthController@showLoginForm');
Route::post('/manage/login','Manage\AuthController@login')->name('manage-login');
Route::post('/manage/logout','Manage\AuthController@logout')->name('manage-logout');

Route::get('/user/update', 'HomeController@updateLayout')->name('update-user');
Route::post('/user/update', 'HomeController@updateUser')->name('updated');
Route::get('/user/info', 'HomeController@showInfo')->name('info');
Route::get('/', 'NewsController@allNews')->name('home');
Route::get('/news/{id}', 'NewsController@show')->name('news-show');

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

    Route::get('/info-user/{email}', 'AdminController@userInfo')->name('info-user');

    Route::post('/user-change', 'AdminController@changeActive')->name('change-user');
    Route::post('/exam-change', 'AdminController@changeShow')->name('change-exam');

    Route::get('/news', 'AdminController@news')->name('news');
    Route::get('/news/list', 'AdminController@showNews')->name('list-news');
    Route::post('/news/store', 'AdminController@store')->name('add');
});
