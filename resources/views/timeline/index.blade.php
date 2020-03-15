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
              {{-- status --}}
            <div class="media">
                <a class="pull-left" href="{{route('profile.index',['username'=> $status->user->username])}}">
                    <img class="mr-3 rounded-circle" style="width:60px;" alt="{{$status->user->getNameOrUsername()}}" src="{{$status->user->getAvatarURL()}}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="{{route('profile.index',['username'=> $status->user->username])}}">{{$status->user->getNameOrUsername()}}</a></h4>
                    <p>{{$status->body}}</p>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                          {{$status->created_at->diffForHumans()}}
                        </li>

                        {{-- A user should not be able to like his own statuses --}}
                        @if ($status->user->id !== Auth::user()->id)
                        <li class="list-inline-item">
                          <a href="{{route('status.like', ['statusId'=>$status->id])}}">
                            <i class="fas fa-thumbs-up"></i>
                          </a>
                        </li>
                        @endif
                      
                        <li class="list-inline-item">
                          10 likes
                        </li>
                    </ul>

                {{-- reply --}}

              @foreach ($status->replies as $reply)
                <div class="media">
                    <a class="pull-left"  href="{{route('profile.index',['username'=> $reply->user->username])}}">
                        <img class="mr-3 rounded-circle" style="width:40px;" alt="{{$reply->user->getNameOrUsername()}}" src="{{$reply->user->getAvatarURL()}}">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">
                          <a class="reply" href="{{route('profile.index',['username'=> $reply->user->username])}}">
                            {{$reply->user->getNameOrUsername()}}
                          </a>
                        </h5>
                        <p>{{$reply->body}}</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                              {{$reply->created_at->diffForHumans()}}
                            </li>

                            {{-- A user shuold not be able to like his own reply --}}
                            @if ($reply->user->id !== Auth::user()->id)
                            <li class="list-inline-item">
                              <a href="{{route('status.like', ['statusId'=>$reply->id])}}">
                                <i class="fas fa-thumbs-up"></i>
                              </a>
                            </li>
                            @endif
                          
                            <li class="list-inline-item">
                              4 likes
                            </li>
                        </ul>
                    </div>
                </div>
              @endforeach


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
