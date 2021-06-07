<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Models\Web;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
* DataStatistik
*/
$router->group(['prefix' => 'statistik'], function () use ($router) {
    $router->get('/', ['uses' => 'DataStatistikController@list']);
    $router->get('temperatur', ['uses' => 'DataStatistikController@temperatur']);
    $router->get('kelembaban', ['uses' => 'DataStatistikController@kelembaban']);
    $router->get('plucks', ['uses' => 'DataStatistikController@plucks']);
    $router->post('create', ['uses' => 'DataStatistikController@create']);
    $router->get('{id}', ['uses' => 'DataStatistikController@read']);
    $router->put('{id}', ['uses' => 'DataStatistikController@update']);
    $router->delete('{id}', ['uses' => 'DataStatistikController@delete']);
});
/**
* DataWeb
*/
$router->group(['prefix' => 'web'], function () use ($router) {
    $router->get('/lampu', ['uses' => 'DataLampuSiramController@lampu']);
    $router->get('/lampu/on', ['uses' => 'DataLampuSiramController@onLampu']);
    $router->get('/lampu/off', ['uses' => 'DataLampuSiramController@offLampu']);
    $router->get('/siram', ['uses' => 'DataLampuSiramController@siram']);
    $router->get('/siram/on', ['uses' => 'DataLampuSiramController@onSiram']);
    $router->get('/siram/off', ['uses' => 'DataLampuSiramController@offSiram']);
});
/**
* DataFoto
*/
$router->group(['prefix' => 'foto'], function () use ($router) {
    $router->get('/', ['uses' => 'DataFotoController@list']);
    $router->get('readfoto', ['uses' => 'DataFotoController@readfoto']);
    $router->get('plucks', ['uses' => 'DataFotoController@plucks']);
    $router->post('create', ['uses' => 'DataFotoController@create']);
    $router->get('{id}', ['uses' => 'DataFotoController@read']);
    $router->put('{id}', ['uses' => 'DataFotoController@update']);
    $router->delete('{id}', ['uses' => 'DataFotoController@delete']);
});

Route::get('tabel-data', function(){
    return view('tabel-data.index');
});

Route::get('status-lampu', function(){
    $data = Web::where('key','lampu')->first();
    if($data->value == 0)
        return response()->json(['status' => 'unchecked']);
    else
        return response()->json(['status' => 'checked']);
});

Route::post('status-lampu/{status}', function($status){
    $data = Web::where('key', 'lampu')->first();
    if($status == 'checked')
        $value = 1;
    else
        $value = 0;
    $data->value = $value;
    $data->save();
    return response()->json(['result' => $value]);
});

Route::get('status-siram', function(){
    $data = Web::where('key','siram')->first();
    if($data->value == 0)
        return response()->json(['status' => 'unchecked']);
    else
        return response()->json(['status' => 'checked']);
});

Route::post('status-siram/{status}', function($status){
    $data = Web::where('key', 'siram')->first();
    if($status == 'checked')
        $value = 1;
    else
        $value = 0;
    $data->value = $value;
    $data->save();
    return response()->json(['result' => $value]);
});

/**
* Index
*/

Route::get('/', function () {
    return view('index');
});