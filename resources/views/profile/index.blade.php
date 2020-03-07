@extends('templates.default')

@section('content')
  <div class="row">
    <div class="col-lg-7">
      @include('user.partials.userblock')
      <hr>
    </div>
    <div class="col-lg-5 float-right">
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
