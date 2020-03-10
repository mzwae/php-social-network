@extends('templates.default')

@section('content')
  <div class="row">
    <div class="col-lg-7">
      @include('user.partials.userblock')
      <hr>
    </div>
    <div class="col-lg-5 float-right">
      @if (Auth::user()->hasFriendRequestPending($user))
        <p>Waiting for {{$user->getNameOrUsername()}} to accept your request.</p>
      @elseif (Auth::user()->hasFriendRequestReceived($user))
        <a href="{{route('friends.accept', ['username' => $user->username])}}" class="btn btn-outline-success my-2 my-sm-0">Accept Friend Request</a>

      @elseif (Auth::user()->isFriendsWith($user))
        <p class="text-success">You and {{$user->getNameOrUsername()}} are friends.</p>
      @elseif (Auth::user()->id !== $user->id)
        <a href="{{route('friends.add', ['username' => $user->username])}}" class="btn btn-outline-success my-2 my-sm-0">Add as friend</a>
      @endif

      <h4>{{$user->getNameOrUsername()}}'s friends list:</h4>

      @if (!$user->friends()->count())
        <p>{{$user->getNameOrUsername()}} has no friends, yet.</p>
      @else
        @foreach ($user->friends() as $user)
          @include('user/partials/userblock')
        @endforeach
      @endif
    </div>
  </div>
@endsection
