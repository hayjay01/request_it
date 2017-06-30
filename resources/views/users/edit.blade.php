@extends('layouts.master')
@extends('partials.header')
@section('content')
  <div class="row">
        <h1 class="">Manage Profile</h1>
  </div>
    <hr>    

	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
       <form method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}

  	     	@if(isset($current_user_image))
			<img src='{{ asset("images/$current_user_image") }}' style="width:100px; height: 100px;" alt="avatar" class="img-responsive avatar img-circle" alt="Image">
		@else
          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar"  style="width:100px; height: 100px;" >
        @endif
          <h6>Upload a different photo...</h6>
          
          <input type="file" name="user_image" class="form-control">
        </div>
      </div>
      
      <!-- edit form column -->
      @if(Session::has('message'))
      <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          <strong>Success: </strong>{{Session::get('message')}}
        </div>
        <h3>Personal info</h3>
      @endif
        <form class="form-horizontal" role="form">
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Username:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="username" value="{{$current_username}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" value="123456">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" value="123456">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8 col-md-offset-3">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <a href="{{ route('users.view_request') }}" class="btn btn-default" > Cancel </a>
            </div>
          </div>
        </form>
      </div>
  </div>
  <hr>
       </form>
        
@endsection

