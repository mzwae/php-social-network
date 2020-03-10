@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form role="form" action="#" method="post">
            <div class="form-group">
                <textarea placeholder="What's up {{$username}}?" name="status" class="form-control" rows="2"></textarea>
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
