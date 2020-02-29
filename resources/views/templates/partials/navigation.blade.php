<nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Social Web</a>
    </div>
    <div class="collapse navbar-collapse">
      @if (Auth::check())
        <ul class="nav navbar-nav">
          <li href="#"><a>Timeline</a></li>
          <li href="#"><a>Friends</a></li>
        </ul>
        <form class="navbar-form navbar-left" role="search" acition="#">
          <div class="form-group">
            <input type="text" name="query" class="form-control" placeholder="Find people">
          </div>
          <button type="sumbit" class="btn btn-default">Search</button>
        </form>
      @endif
      <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
          <li><a href="#">Jack{{Auth::user()->getNameOrUsername()}}</a></li>
          <li><a href="#">Update Profile</a></li>
          <li><a href="#">Sign Out</a></li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="#">Sign up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sign in</a>
          </li>
        @endif
      </ul>
       </div>
    </div>
  </div>
</nav>
