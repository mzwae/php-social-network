@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <form role="form" action="{{route('status.post')}}" method="post">
            <div class="form-group">
                <textarea class="form-control {{$errors->has('status') ? ' is-invalid' : ''}}" placeholder="What's up {{$username}}?" name="status" rows="2"></textarea>
                @if ($errors->has('status'))
                  <span class=" help-block text-danger">
                {{ $errors->first('status') }}
                </span>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Update status</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
        <hr>
    </div>
</div>
@include('templates.partials.timeline', ['authUserIsFriend' => 'true'])
@endsection
