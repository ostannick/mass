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
    return view('home');
});

//Learning
Route::get('/books', function() {
    return view('learn.books');
});

Route::get('/python', function() {
  return view('python.lessons.introduction');
});

Route::resource('/mass', 'MassController');
Route::resource('/peptides', 'PeptideController');

Route::get('/entrez', function() {
  return view('entrez.entrez');
});
Route::post('/entrez/records', 'EntrezController@records');

Route::get('/test', function(){

});
