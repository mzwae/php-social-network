<div class="media border p-3">
  <img src="" alt="{{$user->getNameOrUsername()}}" class="mr-3 mt-3 rounded-circle" style="width:60px;">
  <div class="media-body">
    <h4>{{$user->getNameOrUsername()}}</h4>
    @if ($user->location)
      <p>{{$user->location}}</p>
    @endif
  </div>
</div>
