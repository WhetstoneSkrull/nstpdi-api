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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
  'prefix' => 'auth'
], function(){

  Route::get('user', 'AuthController@user');
  Route::post('signup', 'AuthController@signup');
  Route::post('login', 'AuthController@login');

});

Route::get('all/users', 'UserController@index');
Route::get('all/teachers', 'UserController@teachers');
Route::get('user/{id}', 'UserController@show');
Route::post('user/upload/pic', 'UserController@uploadUserPic');
Route::post('user/snap/pic', 'UserController@snapPic');
Route::patch('user/{user}/update-location', 'UserController@updateLocation');
Route::get('user/{user}/update-time', 'UserController@updateTime');
Route::get('user/{user}/my-courses', 'UserController@myActiveCourse');
Route::patch('user/{user}/make-course_editor', 'UserController@makecourseeditor');
Route::get('user/unenrolled-courses/{user}', 'UserController@unenrolledcourses');
Route::get('user/try-method/{user}', 'UserController@trymethod');


Route::get('all/modules', 'AdminController@allmodules');
Route::get('all/scores', 'AdminController@allscores');

Route::post('option', 'OptionController@store');
Route::put('option', 'OptionController@store');
Route::get('option/{id}', 'OptionController@show');

Route::get('scores', 'ScoreController@index');
Route::post('score', 'ScoreController@store');
Route::put('score', 'ScoreController@store');
Route::get('score/{id}', 'ScoreController@show');

Route::get('subject-areas', 'ThematicAreasController@index');
Route::post('subject', 'ThematicAreasController@store');

Route::get('all-trainings', 'TrainingController@index');
Route::get('active/trainings', 'TrainingController@activetraining');
Route::get('training/{id}', 'TrainingController@show');
Route::post('training', 'TrainingController@store');
Route::put('training', 'TrainingController@store');
Route::patch('training/active/{train}', 'TrainingController@makeActive');
Route::patch('training/closed/{train}', 'TrainingController@makeClosed');

Route::get('questions', 'QuestionController@index');
Route::get('questions/adder', 'QuestionController@getquestionsadder');
Route::get('questions/count', 'QuestionController@countquestions');
Route::get('questions/practice', 'QuestionController@getpracticequestions');
Route::post('question', 'QuestionController@store');
Route::put('question', 'QuestionController@store');
Route::get('question/{id}', 'QuestionController@show');
Route::delete('question/{id}', 'QuestionController@destroy');
