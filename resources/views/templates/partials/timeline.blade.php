<div class="row">
    <div class="col-lg-8">
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
                    <h4 class="media-heading">
                      <a href="{{route('profile.index',['username'=> $status->user->username])}}">
                        {{$status->user->getNameOrUsername()}}
                      </a>
                    </h4>
                    <p>{{$status->body}}</p>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                          Created: {{$status->created_at->diffForHumans()}}
                        </li>

                        @if ($status->user_id === Auth::user()->id)
                        <li class="list-inline-item">
                          <a title="Edit Status" type="button" data-toggle="modal" data-target="#editModal-{{$status->id}}">
                            <i class="fas fa-edit text-info"></i>
                          </a>
                        </li>
                        @endif

                        {{-- A user should not be able to like his own statuses --}}
                        @if ($status->user->isFriendsWith(Auth::user()))
                        <li class="list-inline-item">
                          <a href="{{route('status.like', ['statusId'=>$status->id])}}" title="Like status">
                            <i class="fas fa-thumbs-up"></i>
                          </a>
                        </li>
                        @endif

                        @if ($status->user_id === Auth::user()->id)
                        <li class="list-inline-item">
                          <a data-toggle="modal" data-target="#deleteStatusModal-{{$status->id}}" title="Delete Status">
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
                        
                        
                        <li class="list-inline-item">
                           {{$status->replies()->count()}} 
                           @if($status->replies()->count() == 1)
                            <span>Reply</span>
                           @else
                            <span>Replies</span>
                           @endif
                        </li>
                        
                        @if($status->updated_at != $status->created_at)
                          <li class="list-inline-item">
                            Updated: {{$status->updated_at->diffForHumans()}}
                          </li>
                        @endif

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
                              Created: {{$reply->created_at->diffForHumans()}}
                            </li>

                            @if ($reply->user_id === Auth::user()->id)
                              <li class="list-inline-item">
                                <a title="Edit Status" type="button" data-toggle="modal" data-target="#editModal-{{$reply->id}}">
                                  <i class="fas fa-edit text-info"></i>
                                </a>
                              </li>
                            @endif

                            {{-- A user shuold not be able to like his own reply --}}
                            @if ($reply->user->isFriendsWith(Auth::user()))
                            <li class="list-inline-item">
                              <a href="{{route('status.like', ['statusId'=>$reply->id])}}" title="Like reply">
                                <i class="fas fa-thumbs-up"></i>
                              </a>
                            </li>
                            @endif

                            @if ($reply->user_id === Auth::user()->id)
                            <li class="list-inline-item">
                              <a data-toggle="modal"  data-target="#deleteReplyModal-{{$reply->id}}" title="Delete Reply">
                                <i class="fas fa-trash-alt text-danger"></i>
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

                            @if($reply->updated_at != $reply->created_at)
                              <li class="list-inline-item">
                              Updated: {{$reply->updated_at->diffForHumans()}}
                              </li>
                            @endif
                        </ul>
                    </div>
                </div>
                   <!-- The edit reply Modal -->
                <div class="modal" id="editModal-{{$reply->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Your Reply</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                      <form action="{{route('status.edit', ['statusId'=>$reply->id])}}" method="post">
                          <div class="form-group">
                            <label for="status-body">Edit Reply</label>
                            <textarea class="form-control" name="status-body" id="reply-body" cols="30" rows="10">{{$reply->body}}</textarea>
                          </div>

                          <input type="submit" value="Save" class="btn btn-outline-primary">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                        </form>
                      </div>


                    </div>
                  </div>
                </div>

                <!-- Delete Reply Button Modal HTML -->
                <div id="deleteReplyModal-{{$reply->id}}" class="modal fade delete-modal">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="icon-box">
                          <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title">Are you sure?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <p>Do you really want to delete this? This process cannot be undone.</p>
                      </div>
                      <div class="modal-footer">
                        <form action="{{route('status.delete', ['statusId'=>$reply->id])}}" method="POST">
                          <input value="Delete" type="submit" class="btn btn-danger">
                          @method('DELETE')
                          @CSRF
                        </form>
                        <a type="button" class="btn btn-info" data-dismiss="modal">Cancel</a>
                      </div>
                    </div>
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

                                <!-- The edit status Modal -->
                <div class="modal" id="editModal-{{$status->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Your Status</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                      <form action="{{route('status.edit', ['statusId'=>$status->id])}}" method="post">
                          <div class="form-group">
                            <label for="status-body">Edit Status</label>
                            <textarea class="form-control" name="status-body" id="status-body" cols="30" rows="10">{{$status->body}}</textarea>
                          </div>

                          <input type="submit" value="Save" class="btn btn-outline-primary">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                        </form>
                      </div>


                    </div>
                  </div>
                </div>

                          <!-- Delete Status Button Modal HTML -->
                <div id="deleteStatusModal-{{$status->id}}" class="modal fade delete-modal">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="icon-box">
                          <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title">Are you sure?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <p>Do you really want to delete this? This process cannot be undone.</p>
                      </div>
                      <div class="modal-footer">
                        <form action="{{route('status.delete', ['statusId'=>$status->id])}}" method="POST">
                          <input value="Delete" type="submit" class="btn btn-danger">
                          @method('DELETE')
                          @CSRF
                        </form>
                        <a type="button" class="btn btn-info" data-dismiss="modal">Cancel</a>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        @endif
    </div>
</div>