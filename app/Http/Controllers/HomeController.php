<?php
namespace App\Http\Controllers;

use Auth;

/**
 *
 */
class HomeController extends Controller
{

  public function index()
  {
    $username = Auth::user()->getNameOrUsername();
    if (Auth::check()) {
      return view('timeline.index')->with('username', $username);
    }
    return view('home');
  }
}
