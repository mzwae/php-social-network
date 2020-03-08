@extends('templates.default')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <h3>Your Friends</h3>
        @if (!$friends->count())
          <p>You have no friends, yet.</p>
        @else
          @foreach ($friends as $user)
            @include('user/partials/userblock')
          @endforeach
        @endif
    </div>
    <div class="col-lg-6">
        Friend Requests
    </div>
</div>
@endsection
