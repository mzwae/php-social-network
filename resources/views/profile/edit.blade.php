@extends('templates.default')

@section('content')
  <h3>Update your profile</h3>

  <div class="row">
      <div class="col-lg-6">
        <form class="form-vertical" role="form" method="post" action="{{route('profile.edit')}}">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="first_name" class="control-label">
                  First name
                </label>
                <input value="{{Request::old('first_name') ?: Auth::user()->first_name}}" type="text"  class="form-control {{$errors->has('first_name') ? ' is-invalid' : ''}}" id="first_name" name="first_name">
                @if ($errors->has('first_name'))
                <span class="help-block text-danger">
                    {{ $errors->first('first_name') }}
                </span>
                @endif
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="last_name" class="control-label">
                  Last name
                </label>
                <input value="{{Request::old('last_name') ?: Auth::user()->last_name}}" type="text" name="last_name" class="form-control {{$errors->has('last_name') ? ' is-invalid' : ''}}" id="last_name">
                @if ($errors->has('last_name'))
                <span class="help-block text-danger">
                    {{ $errors->first('last_name') }}
                </span>
                @endif
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="location" class="control-label">
              Location
            </label>
            <input value="{{Request::old('location') ?: Auth::user()->location}}" type="text"  class="form-control {{$errors->has('location') ? ' is-invalid' : ''}}" id="location" name="location" placeholder="City, Country">
            @if ($errors->has('location'))
            <span class="help-block text-danger">
                {{ $errors->first('location') }}
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="email" class="control-label">
              Email
            </label>
            <input value="{{Request::old('email') ?: Auth::user()->email}}" type="text"  class="form-control {{$errors->has('email') ? ' is-invalid' : ''}}" id="email" name="email" placeholder="email">
            @if ($errors->has('email'))
            <span class="help-block text-danger">
                {{ $errors->first('email') }}
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="username" class="control-label">
              Username
            </label>
            <input value="{{Request::old('username') ?: Auth::user()->username}}" type="text"  class="form-control {{$errors->has('username') ? ' is-invalid' : ''}}" id="username" name="username" placeholder="Username">
            @if ($errors->has('username'))
            <span class="help-block text-danger">
                {{ $errors->first('username') }}
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="password" class="control-label">
              Password
            </label>
            <p><a href="#">Update Password</a></p>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">
              Update
            </button>
          </div>
          <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
      </div>
  </div>
@stop
