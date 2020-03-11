@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form role="form" action="{{route('status.post')}}" method="post">
            <div class="form-group">
                <textarea class="form-control {{$errors->has('status') ? ' is-invalid' : ''}}" placeholder="What's up {{$username}}?" name="status" rows="2"></textarea>
                @if ($errors->has('status'))
                  <span class=" help-block text-danger">
                {{ $errors->first('status') }}
                </span>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Update status</button>
        </form>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">
        <!-- Timeline statuses and replies -->
    </div>
</div>
@endsection
