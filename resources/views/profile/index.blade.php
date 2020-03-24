@extends('templates.default')

@section('content')

      <div class="row">
        <div class="col-lg-7">
          @include('user.partials.userblock')
        </div>
        <div class="col-lg-5 float-right">
          @if (Auth::user()->hasFriendRequestPending($user))
            <p>Waiting for {{$user->getNameOrUsername()}} to accept your request.</p>
          @elseif (Auth::user()->hasFriendRequestReceived($user))
            <a href="{{route('friends.accept', ['username' => $user->username])}}" class="btn btn-outline-primary my-2 my-sm-0">Accept Friend Request</a>

          @elseif (Auth::user()->isFriendsWith($user))
            <p class="text-success">You and {{$user->getNameOrUsername()}} are friends.</p>
        <form action="{{route('friends.delete', ['username'=>$user->username])}}" method="post">
              <input type="submit" value="Delete friend" class="btn btn-outline-primary my-4">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            </form>
          @elseif (Auth::user()->id !== $user->id)
            <a href="{{route('friends.add', ['username' => $user->username])}}" class="btn btn-outline-primary my-2 my-sm-0">Add as friend</a>
          @endif

          <h4>{{$user->getNameOrUsername()}}'s friends list:</h4>

          @if (!$user->friends()->count())
            <p>{{$user->getNameOrUsername()}} has no friends, yet.</p>
          @else
            @foreach ($user->friends() as $user)
              @include('user/partials/userblock')
            @endforeach
          @endif
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-lg-5">
            <!-- Timeline statuses and replies -->
            @if (!$statuses->count())
                <p>There's nothing in your timeline, yet.</p>
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
                            @if ($status->user->isFriendsWith(Auth::user()))
                            <li class="list-inline-item">
                              <a href="{{route('status.like', ['statusId'=>$status->id])}}">
                                <i class="fas fa-thumbs-up"></i>
                              </a>
                            </li>
                            @endif

                            @if ($status->user_id === Auth::user()->id)
                            <li class="list-inline-item">
                              <a href="{{route('status.delete', ['statusId'=>$status->id])}}"  data-toggle="tooltip" title="Delete Status">
                                <i class="fas fa-trash-alt text-danger"></i>
                              </a>
                            </li>
                            @endif
                          
                            <li class="list-inline-item">
                              {{$status->likes->count()}} 
                              @if($status->likes->count() == 1)
                                  <span>Like</span>
                              @else
                                  <span>Likes</span>
                              @endif
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
                                @if ($reply->user->isFriendsWith(Auth::user()))
                                <li class="list-inline-item">
                                  <a href="{{route('status.like', ['statusId'=>$reply->id])}}">
                                    <i class="fas fa-thumbs-up"></i>
                                  </a>
                                </li>
                                @endif
                              
                                <li class="list-inline-item">
                                  {{$reply->likes->count()}} 
                                  @if($reply->likes->count() == 1)
                                      <span>Like</span>
                                  @else
                                      <span>Likes</span>
                                  @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                  @endforeach
    
    
        
                       @if ($authUserIsFriend || Auth::user()->id === $status->user_id)
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
                        @endif 
                    </div>
                </div>
                <hr>
                @endforeach
                {{-- {{$statuses->render()}} --}}
            @endif
        </div>
    </div>
    @endsection