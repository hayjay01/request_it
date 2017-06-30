@extends('layouts.master')

@include('partials.header')

@section('content')
		<div class="row">
			<div class="col-lg-10">
				
				<h1> 
				<div style="display: inline-block; float: left; margin-right:10px;">
													<?php 
														$img = $view_request->user->user_image ;
														// var_dump($img); exit;
													?>
													<img src='{{ asset("images/$img") }}' class="img-responsive text-left img-circle" width="50" height="50" alt="Image">	
													
				</div> {{$view_request->request_title}}  </h1><small class="glyphicon glyphicon-time"> Posted @ {{$view_request->created_at->toFormattedDateString()}} </small> 			
						 <b><hr></b>

						<div>

							<b style="color: red;">Content: </b> {{$view_request->body}}
						</div>				
			</div>



		</div>
@endsection