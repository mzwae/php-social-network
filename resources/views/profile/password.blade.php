@extends('templates.default')

@section('content')
  <h3 class="text-center">Update your password</h3>

        <form class="form-vertical text-center" role="form" method="post" action="{{route('profile.password')}}">
              <div class="form-group w-50 offset-md-3">
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
              <div class="form-group w-50 offset-md-3">
                <label for="confirm" class="control-label">
                  Confirm your new password
                </label>
                <input value="" type="password" name="password_confirmation" class="form-control {{$errors->has('password_confirmation') ? ' is-invalid' : ''}}" id="password_confirmation">
                @if ($errors->has('password_confirmation'))
                <span class="help-block text-danger">
                    {{ $errors->first('password_confirmation') }}
                </span>
                @endif
              </div>
              
          
          <div class="form-group">
            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">
              Update
            </button>
          </div>
          <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
@stop
