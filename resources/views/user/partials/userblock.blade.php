<div class="media p-3">
  <a href="{{route('profile.index', ['username'=>$user->username])}}">
  <img src="{{$user->getAvatarURL()}}" alt="{{$user->getNameOrUsername()}}" class="mr-3 rounded-circle" style="width:60px;">
  <div class="media-body">
    <h5>{{$user->getNameOrUsername()}}</h5>
    @if ($user->location)
      <p>{{$user->location}}</p>
    @endif
  </div>
  </a>
</div>
