@extends('layout')
  @section('content')
  <br>
  @if(Session::get('notAllowed'))
    <div class="alert alert-danger mx-auto" style="width: 30cm; height:auto;">
        {{Session::get('notAllowed')}}

    </div>
  @endif
  <div style="margin-bottom: 40px;">
    <div class="col-lg-6 image-welcome">
      <img src="{{asset('assets/image/todo.jpg')}}">
    </div>
    <a href="/dashboard/maketodo" style="text-decoration: none;">
      <button type="button" class="btn d-block mr-auto mt-3 btn-lg text-white" style="margin-left:18cm; background-color:#DD5353; text-decoration:none;">Make Todo</button>
    </a>
  </div>
@endsection 
