@extends('templates.default')

@section('content')
  <h3>Update your profile</h3>

  <div class="row">
      <div class="col-lg-6">
        <form class="form-vertical" role="form" method="post" action="{{route('profile.edit')}}">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="first_name" class="control-label">
                  First name
                </label>
                <input type="text" name="first_name" class="form-control" id="first_name" value="">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="last_name" class="control-label">
                  Last name
                </label>
                <input type="text" name="last_name" class="form-control" id="last_name" value="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="location" class="control-label">
              Location
            </label>
            <input type="text" name="location" class="form-control" id="location" value="">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-outline-success my-2 my-sm-0">
              Update
            </button>
          </div>
          <input type="hidden" name="_token" value="Session::token()">
        </form>
      </div>
  </div>
@stop
