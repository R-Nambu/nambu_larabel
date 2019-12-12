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

Route::get('/', 'DiaryController@index')->name('diary.index');
Route::get('diary/create', 'DiaryController@create')->name('diary.create'); // 投稿画面
Route::post('diary/create', 'DiaryController@store')->name('diary.store'); // 保存処理
Route::delete('diary/{id}/delete', 'DiaryController@destroy')->name('diary.destroy'); // 削除処理
Route::get('diary/{id}/edit', 'DiaryController@edit')->name('diary.edit'); // 編集画面
Route::put('diary/{id}/update', 'DiaryController@update')->name('diary.update'); //更新処理

// Route::get('/', function () {
//     return view('welcome');
// });
