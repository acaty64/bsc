<?php

use App\Avance;
use App\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/avances', function () {
    return view('app.avances');
});

Route::get('/panel', function () {
    return view('app.panel');
});

Route::get('/grid', function () {
    return view('grid');
});

Route::get('/example', function () {
    return view('example');
});

// Ruta para carga de archivos PDF
Route::get('storage/{path}/{filename}', function ($path, $filename)
{
    $path = storage_path('app/' . $path . '/' . $filename);


    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/******************************************************************************/
/******************************************************************************/
Route::post('users/store', [
    'as'    => 'users.store',
    'uses'  => 'UserController@store'
]);
Route::post('users/update', [
    'as'    => 'users.update',
    'uses'  => 'UserController@update'
]);
Route::delete('users/destroy/{id}', [
    'as'    => 'users.destroy',
    'uses'  => 'UserController@destroy'
]);


Route::post('perspectivas/store', [
    'as'    => 'perspectivas.store',
    'uses'  => 'PerspectivaController@store'
]);
Route::post('perspectivas/update', [
    'as'    => 'perspectivas.update',
    'uses'  => 'PerspectivaController@update'
]);
Route::delete('perspectivas/destroy/{id}', [
    'as'    => 'perspectivas.destroy',
    'uses'  => 'PerspectivaController@destroy'
]);

Route::post('objetivos/store', [
    'as'    => 'objetivos.store',
    'uses'  => 'ObjetivoController@store'
]);
Route::post('objetivos/update', [
    'as'    => 'objetivos.update',
    'uses'  => 'ObjetivoController@update'
]);
Route::delete('objetivos/destroy/{id}', [
    'as'    => 'objetivos.destroy',
    'uses'  => 'ObjetivoController@destroy'
]);

Route::post('iniciativas/store', [
    'as'    => 'iniciativas.store',
    'uses'  => 'IniciativaController@store'
]);
Route::post('iniciativas/update', [
    'as'    => 'iniciativas.update',
    'uses'  => 'IniciativaController@update'
]);
Route::delete('iniciativas/destroy/{id}', [
    'as'    => 'iniciativas.destroy',
    'uses'  => 'IniciativaController@destroy'
]);



/******************************************************************************/
/******************************************************************************/




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
