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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [
  'uses' => '\App\Http\Controllers\HomeController@index',
  'as' => 'home',
]);

// Route::get('/alert', function(){
//   return redirect()->route('home')->with('info', 'You have signed up!');
// });

Route::get('/signup', [
  'uses' => '\App\Http\Controllers\AuthController@getSignup',
  'as' => 'auth.signup',
  'middleware' => ['guest'],
]);

Route::post('/signup', [
  'uses' => '\App\Http\Controllers\AuthController@postSignup',
  'middleware' => ['guest'],
]);

Route::get('/signin', [
  'uses' => '\App\Http\Controllers\AuthController@getSignin',
  'as' => 'auth.signin',
  'middleware' => ['guest'],
]);

Route::post('/signin', [
  'uses' => '\App\Http\Controllers\AuthController@postSignin',
  'middleware' => ['guest'],
]);

Route::get('/signout', [
  'uses' => '\App\Http\Controllers\AuthController@getSignout',
  'as' => 'auth.signout',
]);

/*Search*/
Route::get('/search', [
  'uses' => '\App\Http\Controllers\SearchController@getResults',
  'as' => 'search.results',
]);

/*User Profile*/
Route::get('/user/{username}', [
  'uses' => '\App\Http\Controllers\ProfileController@getProfile',
  'as' => 'profile.index',
]);
Route::get('/profile/edit', [
  'uses' => '\App\Http\Controllers\ProfileController@getEdit',
  'as' => 'profile.edit',
  'middleware' => ['auth'],
]);
Route::post('/profile/edit', [
  'uses' => '\App\Http\Controllers\ProfileController@postEdit',
  'middleware' => ['auth'],
]);

/*Friends*/
Route::get('/friends', [
  'uses' => '\App\Http\Controllers\FriendController@getIndex',
  'as' => 'friends.index',
  'middleware' => ['auth'],
]);

// Test
Route::get('/test', [
  'uses' => '\App\Http\Controllers\test@displayTest',
  'as' => 'app.test',
]);
