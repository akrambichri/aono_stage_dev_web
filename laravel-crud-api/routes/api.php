<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Equipe routes
Route::get('equipes', 'Api\EquipeController@index');
Route::get('equipes/matches', 'Api\EquipeController@getTeamsWithUpcomingMatch');
Route::get('equipes/{id}', 'Api\EquipeController@show');
Route::post('equipes', 'Api\EquipeController@store');
Route::put('equipes/{id}', 'Api\EquipeController@update');
Route::delete('equipes/{id}','Api\EquipeController@destroy');

//Matchs routes
Route::get('matches', 'Api\MatchController@index');
Route::get('matches/{id}', 'Api\MatchController@show');
Route::post('matches', 'Api\MatchController@store');
Route::put('matches/{id}', 'Api\MatchController@update');
Route::delete('matches/{id}','Api\MatchController@destroy');