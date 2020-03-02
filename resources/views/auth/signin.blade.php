@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form class="form-vertical" role="form" method="post" action="{{route('auth.signin')}}">
            <div class="form-group">
                <label for="email" class="control-label">Email</label>
                <input type="text" name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <div class="form-gorup">
                <button type="submit" class="btn btn-success">Sign in</button>
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
</div>
@stop
