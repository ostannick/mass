<?php

Route::get('/', function () {
    return view('home');
});

Route::get('/cv', function (){
    return view('cv.cv');
});

Route::get('/publications', function(){
    return view('cv.publications.publications');
});

Route::get('dashboard', function() {
    return view('auth.dashboard');

})->middleware('auth');

Route::get('admin', function() {
    return view('admin.dashboard');

})->middleware('auth');

//Learning
Route::get('/books', function() {
    return view('learn.books');
});
Route::get('/xtalcourse', function() {
  return view('xtalcourse.introduction');
});
Route::get('/xtalcourse/dna', function() {
  return view('xtalcourse.dna');
});

Route::resource('/mass', 'MassController');
Route::resource('/peptides', 'PeptideController');
Route::resource('/depc', 'DepcController');
Route::get('/analyze', 'PeptideController@analyze');

Route::resource('/prosecco', 'ProseccoController');

Route::get('/entrez', function() {
  return view('entrez.entrez');
});
Route::post('/entrez/records', 'EntrezController@records');

Route::get('/test', function(){
  return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
