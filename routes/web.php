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
  'uses' => 'HomeController@index',
  'as' => 'home',
]);

Route::view('/about', 'about')->name('about');

// Route::get('/alert', function(){
//   return redirect()->route('home')->with('info', 'You have signed up!');
// });

Route::get('/signup', [
  'uses' => 'AuthController@getSignup',
  'as' => 'auth.signup',
  'middleware' => ['guest'],
]);

Route::post('/signup', [
  'uses' => 'AuthController@postSignup',
  'middleware' => ['guest'],
]);

Route::get('/signin', [
  'uses' => 'AuthController@getSignin',
  'as' => 'auth.signin',
  'middleware' => ['guest'],
]);

Route::post('/signin', [
  'uses' => 'AuthController@postSignin',
  'middleware' => ['guest'],
]);

Route::get('/signout', [
  'uses' => 'AuthController@getSignout',
  'as' => 'auth.signout',
]);

/*Search*/
Route::get('/search', [
  'uses' => 'SearchController@getResults',
  'as' => 'search.results',
]);

/*User Profile*/
Route::get('/user/{username}', [
  'uses' => 'ProfileController@getProfile',
  'as' => 'profile.index',
]);
Route::get('/profile/edit', [
  'uses' => 'ProfileController@getEdit',
  'as' => 'profile.edit',
  'middleware' => ['auth'],
]);
Route::post('/profile/edit', [
  'uses' => 'ProfileController@postEdit',
  'middleware' => ['auth'],
]);

Route::get('/profile/password', [
  'uses' => 'ProfileController@getUpdatePassword',
  'as' => 'profile.password',
  'middleware' => ['auth'],
]);

Route::post('/profile/password', [
  'uses' => 'ProfileController@postUpdatePassword',
  'as' => 'profile.passwordChange',
  'middleware' => ['auth'],
]);

/*Friends*/
Route::get('/friends', [
  'uses' => 'FriendController@getIndex',
  'as' => 'friends.index',
  'middleware' => ['auth'],
]);
Route::get('/friends/add/{username}', [
  'uses' => 'FriendController@getAdd',
  'as' => 'friends.add',
  'middleware' => ['auth'],
]);
Route::get('/friends/accept/{username}', [
  'uses' => 'FriendController@getAccept',
  'as' => 'friends.accept',
  'middleware' => ['auth'],
]);

Route::delete('/friends/delete/{username}', [
  'uses' => 'FriendController@postDelete',
  'as' => 'friends.delete',
  'middleware' => ['auth'],
]);

/*Statuses*/
Route::post('/status', [
  'uses' => 'StatusController@postStatus',
  'as' => 'status.post',
  'middleware' => ['auth'],
]);
Route::post('/status/{statusId}/reply', [
  'uses' => 'StatusController@postReply',
  'as' => 'status.reply',
  'middleware' => ['auth'],
]);
Route::get('/status/{statusId}/like', [
  'uses' => 'StatusController@getLike',
  'as' => 'status.like',
  'middleware' => ['auth'],
]);

Route::delete('/status/{statusId}/delete', [
  'uses' => 'StatusController@deleteStatus',
  'as' => 'status.delete',
  'middleware' => ['auth'],
]);

Route::post('/status/{statusId}/edit', [
  'uses' => 'StatusController@editStatus',
  'as' => 'status.edit',
  'middleware' => ['auth'],
]);





// Test
// Route::get('/test', [
//   'uses' => 'test',
//   'as' => 'app.test',
// ]);

