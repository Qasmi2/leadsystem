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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Excel file importing 

Route::get('importexport', 'ExcelController@importExport')->name('importexport')->middleware('auth');
Route::get('downloadexcel/{type}', 'ExcelController@downloadExcel')->name('downloadexcel')->middleware('auth');
Route::get('downloadcvs/{type}', 'ExcelController@downloadExcelSpecific')->name('downloadcvs')->middleware('auth');
Route::post('importexcel', 'ExcelController@importExcel')->name('importexcel')->middleware('auth');

