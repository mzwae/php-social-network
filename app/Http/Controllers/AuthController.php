<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

/**
 *
 */
class AuthController extends Controller
{

  public function getSignup()
  {
    return view('auth.signup');
  }

  public function postSignup(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|unique:users|email|max:225',
      'username' => 'required|unique:users|alpha_dash|max:20',
      'password' => 'required|min:6',
    ]);
    User::create([
      'email' => $request->input('email'),
      'username' => $request->input('username'),
      'password' => bcrypt($request->input('password')),
    ]);

    return redirect()
    ->route('home')
    ->with('info', 'Your account has been created successfully. Please sign in to be able to use SocialWeb.');
  }

  public function getSignin()
  {
    return view('auth.signin');
  }

  public function postSignin(Request $request)
  {
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required',
    ]);
    if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
      return redirect()->back()->with('info', 'Could not sign you in wth those details.');
    }

    return redirect()->route('home')->with('info', 'You are now signed in.');
  }

  public function getSignout(){
    Auth::logout();
    return redirect()->route('home');
  }

  public function authenticate(Request $request) {
    return $request->user();
}
  }
