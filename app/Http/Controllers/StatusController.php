<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Like;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:1000',
        ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        return redirect()
            ->route('home')
            ->with('info', 'Your new status has been posted successfully :)');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:1000',
        ], [
            'required' => 'The reply body is required, stop being lazy and write something',
        ]);
        $status = Status::notReply()->find($statusId);

        if (!$status) {
            return redirect()->route('home');
        }

        if (!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) {
            return redirect()->route('home');
        }

        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
            'user_id' => Auth::user()->id,
        ]);

        $status->replies()->save($reply);
        return redirect()->back();
    }
/* -------------------------------------------------------------------------- */

    /*Register user likes*/
    public function getLike($statusId)
    {
        $status = Status::find($statusId);

        if (!$status) {
            return redirect()->route('home');
        }

        // If the user is not friends with the status/reply creator
        if (!Auth::user()->isFriendsWith($status->user)) {
            return redirect()->route('home');
        }

        // if the user has already liked the status or reply
        if (Auth::user()->hasLikedStatus($status)) {
            return redirect()->back()->with('info', 'You have already liked this before 😊');
        }


        // No need to save the instance as this's handled as a part of the model's create() method
       $status->likes()->create([
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('info', 'Successfully liked 😊');

    }

    public function deleteStatus($statusId)
    {
        $status = Status::find($statusId);

        if (!$status) {
            return redirect()->route('home')->with('info', 'Could not be found.');
        }

        if (Auth::user()->id !== $status->user_id) {
            return redirect()->back()->with('info', 'You can only delete your own stuff 😊');
        }

        // dd($status->replies->parent_id);
        if ($status->replies) {
            // Status::destroy($status->replies);
            Status::where('parent_id', $statusId)->delete();
        }
        if ($status->likes) {
            // Status::destroy($status->likes);
            Like::where('likeable_id', $statusId)->delete();
        }

        Status::destroy($statusId);
        return redirect()->back()->with('info', 'Deleted successfully 😊');

    }

    public function editStatus(Request $request, $statusId){
        $this->validate($request, [
            'status-body' => 'required|max:1000',
        ]);

        $status = Status::find($statusId);

        $status->body = $request['status-body'];

        $status->save();


        return redirect()->back()->with('info', 'Updated Successfully 😊');
    }
}
