@extends('templates.default')

@section('content')

      <div class="row">
        <div class="col-lg-7">
          @include('user.partials.userblock')
        </div>
        <div class="col-lg-5 float-right">
          @if (Auth::user()->hasFriendRequestPending($user))
            <p>Waiting for {{$user->getNameOrUsername()}} to accept your request.</p>
          @elseif (Auth::user()->hasFriendRequestReceived($user))
            <a href="{{route('friends.accept', ['username' => $user->username])}}" class="btn btn-outline-primary my-2 my-sm-0">Accept Friend Request</a>

          @elseif (Auth::user()->isFriendsWith($user))
            <p class="text-success">You and {{$user->getNameOrUsername()}} are friends.</p>
        <form action="{{route('friends.delete', ['username'=>$user->username])}}" method="post">
            <input type="submit" value="Delete friend" class="btn btn-outline-primary my-4">
            @csrf
            @method('delete')
        </form>
          @elseif (Auth::user()->id !== $user->id)
            <a href="{{route('friends.add', ['username' => $user->username])}}" class="btn btn-outline-primary my-2 my-sm-0">Add as friend</a>
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
      <hr>
      @include('templates.partials.timeline')
@endsection
