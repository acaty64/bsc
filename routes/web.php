<?php

use App\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('app.avances');
});

Route::get('/grid', function () {
    return view('grid');
});

Route::get('/example', function () {
    return view('example');
});

/******INICIO EJEMPLO MEDIA ***************/
/******https://styde.net/almacenamiento-streaming-y-descarga-de-archivos-en-laravel-5-5/***************/
Route::get('/media', function () {
    return view('media');
});
Route::post('/media', function () {
    //request()->validate(['file' => 'image']);
    return request()->file->store('uploads');
    //return request()->file->storeAs('uploads', request()->file->getClientOriginalName());
});
/******FIN EJEMPLO MEDIA***************/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

