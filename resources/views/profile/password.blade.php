@extends('templates.default')

@section('content')
  <h3>Update your password</h3>

  <div class="row">
      <div class="col-lg-6">
        <form class="form-vertical" role="form" method="post" action="{{route('profile.password')}}">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="password" class="control-label">
                  Your new password
                </label>
                <input value="" type="password"  class="form-control {{$errors->has('password') ? ' is-invalid' : ''}}" id="password" name="password">
                @if ($errors->has('first_name'))
                <span class="help-block text-danger">
                    {{ $errors->first('password') }}
                </span>
                @endif
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="confirm" class="control-label">
                  Confirm your new password
                </label>
                <input value="" type="password" name="confirm" class="form-control {{$errors->has('confirm') ? ' is-invalid' : ''}}" id="confirm">
                @if ($errors->has('confirm'))
                <span class="help-block text-danger">
                    {{ $errors->first('confirm') }}
                </span>
                @endif
              </div>
            </div>
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
