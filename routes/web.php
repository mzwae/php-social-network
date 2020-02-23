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
]);
Route::post('/signup', [
  'uses' => '\App\Http\Controllers\AuthController@postSignup',
  
]);
