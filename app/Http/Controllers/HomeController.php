<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Status;
/**
 *
 */
class HomeController extends Controller
{

  public function index()
  {
    if (Auth::check()) {
      $username = Auth::user()->getNameOrUsername();

      $statuses = Status::notReply()
      ->where(function($query){
        return $query->where('user_id', Auth::user()->id)
                     ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
      })
      ->orderBy('created_at', 'desc')
      ->paginate(5);

      return view('timeline.index')
            ->with('username', $username)
            ->with('statuses', $statuses);
    }
    return view('home');
  }
}
