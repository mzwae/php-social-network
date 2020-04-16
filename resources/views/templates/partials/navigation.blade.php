<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="{{route('home')}}">SocialWeb 😊</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Route::is('about') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('about')}}">About</a>
            </li>
            @if (Auth::check())
            <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('home')}}">Timeline</a>
            </li>
            <li class="nav-item {{ Route::is('friends.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('friends.index')}}">Friends</a>
            </li>

            <form class="form-inline" action="{{route('search.results')}}">
                <input name="query" class="form-control mr-sm-2" type="search" placeholder="Find People" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
            @endif
        </ul>
        <ul class="navbar-nav mr-right">
            @if (Auth::check())
            <li class="nav-item {{ Route::is('profile.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('profile.index', ['username'=>Auth::user()->username])}}">
                  {{Auth::user()->getNameOrUsername()}}
                </a>
            </li>
            <li class="nav-item {{ Route::is('profile.edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('profile.edit')}}">Update Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('auth.signout')}}">Sign Out</a>
            </li>
            @else
            <li class="nav-item {{ Route::is('auth.signup') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('auth.signup')}}">Sign up</a>
            </li>
            <li class="nav-item {{ Route::is('auth.signin') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('auth.signin')}}">Sign in</a>
            </li>
            @endif
        </ul>
    </div>
  </div>
</nav>





{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}">Social Web</a>
</div>
<div class="navbar-collapse collapse dual-collapse2">
    @if (Auth::check())
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Timeline</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Friends</a>
        </li>
    </ul>

    <form class="form-inline">
        <input class="form-control" type="search" placeholder="Search people" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    @endif
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            @if (Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="#">Jack</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Update Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Sign Out</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('auth.signup')}}">Sign up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('auth.signin')}}">Sign in</a>
            </li>
            @endif
        </ul>
    </div>
</div>
</div>
</nav> --}}
