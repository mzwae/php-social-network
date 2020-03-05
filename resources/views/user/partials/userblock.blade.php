<div class="media border p-3">
  <img src="{{$user->getAvatarURL()}}" alt="{{$user->getNameOrUsername()}}" class="mr-3 rounded-circle" style="width:60px;">
  <div class="media-body">
    <h5>{{$user->getNameOrUsername()}}</h5>
    @if ($user->location)
      <p>{{$user->location}}</p>
    @endif
  </div>
</div>
