<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController2;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//Route::apiResource('/tasks','TaskController2@index');
Route::get('/tasks', 'App\Http\Controllers\TaskController@index');
Route::get('/tasks/{task}', 'App\Http\Controllers\TaskController@show');
Route::post('/tasks', 'App\Http\Controllers\TaskController@store');
Route::put('/tasks/{task}', 'App\Http\Controllers\TaskController@update');
Route::delete('/tasks/{task}', 'App\Http\Controllers\TaskController@destroy');

Route::get('/questions', 'App\Http\Controllers\QuestionsController@index');
Route::get('/questions/{question}', 'App\Http\Controllers\QuestionsController@show');
Route::post('/questions', 'App\Http\Controllers\QuestionsController@store');
Route::put('/questions/{question}', 'App\Http\Controllers\QuestionsController@update');
Route::delete('/questions/{question}', 'App\Http\Controllers\QuestionsController@destroy');

Route::get('/questionSets', 'App\Http\Controllers\QuestionSetsController@index');
Route::post('/questionSets', 'App\Http\Controllers\QuestionSetsController@store');
Route::put('/questionSets/{questionSet}', 'App\Http\Controllers\QuestionSetsController@update');
Route::delete('/questionSets/{questionSet}', 'App\Http\Controllers\QuestionSetsController@destroy');

Route::post('/grouping', 'App\Http\Controllers\GroupingController@store');
Route::put('/grouping', 'App\Http\Controllers\GroupingController@update');
Route::delete('/grouping/{setsId}', 'App\Http\Controllers\GroupingController@destroy');

Route::get('/questionSet/{questionSet}', 'App\Http\Controllers\QuestionSetsController@fetch');