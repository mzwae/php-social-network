@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form class="form-vertical" role="form" method="post" action="{{route('auth.signin')}}">
            <div class="form-group">
                <label for="email" class="control-label">Email</label>
                <input class="form-control {{$errors->has('email') ? ' is-invalid' : ''}}" type="text" name="email" id="email" value="{{Request::old('email') ?: ''}}">
                @if ($errors->has('email'))
                  <span class=" help-block text-danger">
                {{ $errors->first('email') }}
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input class="form-control {{$errors->has('password') ? ' is-invalid' : ''}}" type="password" name="password" id="password">
                @if ($errors->has('password'))
                <span class="help-block text-danger">
                    {{ $errors->first('password') }}
                </span>
                @endif
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <div class="form-gorup">
                <button type="submit" class="btn btn-outline-success">Sign in</button>
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
</div>
@stop
