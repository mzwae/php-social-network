@extends('templates.default')

@section('content')
<h3>Your search for "{{Request::input('query')}}"</h3>
<div class="row">
  <div class="col-lg-12">
    @include('user/partials/userblock')
  </div>
</div>
@stop
