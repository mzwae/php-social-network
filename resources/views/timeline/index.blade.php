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
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">
        <!-- Timeline statuses and replies -->
        @if (!$statuses->count())
            <p>Therei's nothing in your timeline, yet.</p>
        @else
            @foreach ($statuses as $status)
            <div class="media">
                <a class="pull-left" href="{{route('profile.index',['username'=> $status->user->username])}}">
                    <img class="mr-3 rounded-circle" style="width:60px;" alt="{{$status->user->getNameOrUsername()}}" src="{{$status->user->getAvatarURL()}}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="{{route('profile.index',['username'=> $status->user->username])}}">{{$status->user->getNameOrUsername()}}</a></h4>
                    <p>{{$status->body}}</p>
                    <ul class="list-inline">
                        <li class="list-inline-item">{{$status->created_at->diffForHumans()}}</li>
                        <li class="list-inline-item"><a href="#">Like</a></li>
                        <li class="list-inline-item">10 likes</li>
                    </ul>
{{--
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" alt="" src="">
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Jack</a></h5>
                            <p>Yes, it is lovely!</p>
                            <ul class="list-inline">
                                <li>8 minutes ago.</li>
                                <li><a href="#">Like</a></li>
                                <li>4 likes</li>
                            </ul>
                        </div>
                    </div> --}}


                    <form role="form" action="{{route('status.reply', ['statusId' => $status->id])}}" method="post">
                        <div class="form-group">
                            <textarea name="reply-{{$status->id}}" class="form-control {{$errors->has("reply-{$status->id}") ? ' is-invalid' : ''}}" rows="2" placeholder="Reply to this status"></textarea>
                            @if ($errors->has("reply-{$status->id}"))
                              <span class="help-block text-danger">{{$errors->first("reply-{$status->id}")}}</span>
                            @endif
                        </div>
                        <input type="submit" value="Reply" class="btn btn-outline-primary">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </form>
                </div>
            </div>
            <hr>
            @endforeach
            {{$statuses->render()}}
        @endif
    </div>
</div>
@endsection
