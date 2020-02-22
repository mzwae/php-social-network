@extends('templates.default')
@section('content')
<div class="row">
  <div class="col-lg-6">
    <form class="form-vertical" role="form" method="post" action="{{route('auth.signup')}}">
      <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
        <label for="email" class="control-label">Your email address</label>
        <input type="text" name="email" class="form-control" id="email" value="{{ Request::old('email') ?: ''}}">
        @if ($errors->has('email'))
          <span class="help-block">{{ $errors->first('email') }}</span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
        <label for="username" class="control-label">Choose a username</label>
        <input type="text" name="username" value="" class="form-control" id="username">
        @if ($errors->has('username'))
          <span class="help-block">{{ $errors->first('username')}}</span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
        <label for="username" class="control-label">Choose a password</label>
        <input type="password" name="password" value="" class="form-control" id="password">
        @if ($errors->has('password'))
          <span class="help-block">{{ $errors->first('password')}}</span>
        @endif
      </div>

      <div class="form-group">
        <button type="submit" name="_token" value="{{ Session::token()}}">Submit</button>
      </div>
    </form>
  </div>
</div>
@endsection
