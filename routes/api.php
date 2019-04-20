<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/', function (Request $request) {
    dd($request);
});

/*
	PANEL
*/

Route::get('panel/getData', [
	'as'	=> 'panel.getData',
	'uses'	=> 'Api\PanelController@getData'
]);

/*	
	AVANCES
*/
Route::post('avances/storeFileTemp', [
	'as'	=> 'avance.storeFileTemp',
	'uses'	=> 'Api\AvanceController@storeFileTemp'
]);

Route::post('avances/storeFile', [
	'as'	=> 'avance.storeFile',
	'uses'	=> 'Api\AvanceController@storeFile'
]);

Route::post('avances/store', [
	'as'	=> 'avance.store',
	'uses'	=> 'Api\AvanceController@store'
]);

Route::post('avances/update', [
	'as'	=> 'avance.update',
	'uses'	=> 'Api\AvanceController@update'
]);

Route::get('avances/getData/{id}', [
	'as'	=> 'avance.getData',
	'uses'	=> 'Api\AvanceController@getData'
]);

Route::get('avances/published/{id}', [
	'as'	=> 'avance.published',
	'uses'	=> 'Api\AvanceController@published'
]);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

