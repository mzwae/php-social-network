<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function getProfile($username)
    {
      $user = User::where('username', $username)->first();

      if (!$user) {
        abort(404);
      }

      return view('profile.index')->with('user', $user);
    }

    public function getEdit(){
      return view('profile.edit');
    }


    public function postEdit(){

    }


}
