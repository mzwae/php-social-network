<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('friends.index')
            ->with('friends', $friends)
            ->with('requests', $requests);
    }

    public function getAdd($username)
    {
      $user = User::where('username', $username)->first();

      if (!$user) {
        return redirect()
        ->route('home')
        ->with('info', 'That use could not be found');
      }

      if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
        return redirect()
        ->route('profile.index', ['username' => $user->username])
        ->with('info', 'Friend request already pending.');
      }

      if (Auth::user()->isFriendsWith($user)) {
        return redirect()
        ->route('profile.index', ['username' => $user->username])
        ->with('info', 'Dude, you are already friends with this guy. Why are you trying to add him again?');
      }

      Auth::user()->addFriend($user);
      return redirect()
      ->route('profile.index', ['username' => $username])
      ->with('info', 'Your friend request has been sent.');
    }


}
