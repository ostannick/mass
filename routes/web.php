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

//Learning
Route::get('/books', function() {
    return view('learn.books');
});

Route::get('/python', function() {
  return view('python.lessons.introduction');
});

Route::resource('/mass', 'MassController');
Route::resource('/peptides', 'PeptideController');
Route::get('/analyze', 'PeptideController@analyze');

Route::get('/entrez', function() {
  return view('entrez.entrez');
});
Route::post('/entrez/records', 'EntrezController@records');
