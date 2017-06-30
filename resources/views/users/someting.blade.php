@extends('layouts.master')
@extends('partials.header')
@section('content')
{{-- 	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Search</h1>
			</center>
		</div>
	</div> --}}
				@if(!$join)
						<div class="row">
							<div class="col-lg-6 col-lg-offset-3">
									
											<div class="row">
												<h1>NO RESULT FOUND!</h1>
											</div>
							</div>
						</div>
				@else

							<div class="row">
									<div class="col-lg-2">
											<div class="panel panel-default bg_gray">
												<div class="panel-heading">
													<h3 class="panel-title"> <i class="fa fa-tachometer" aria-hidden="true"></i> Actions</h3>
												</div>
												<div class="panel-body">
													<li> <a href="">See all posts  </a> </li>
													<hr>
													<li> <a href="">Accepted Request</a>  </li>
													<hr>
													<li> <a href="">Rejected Request</a>  </li>
													<hr>
													<li> <a href="">Deleted Request <span class="badge">5</span> </a>  </li>
												</div>
											</div>
									</div>

									<div class="col-lg-8">
										<div class="panel panel-default" id="panel_dashboard">
					<div class="panel-heading">
						<h3 class="panel-title"> <span class="glyphicon glyphicon-menu-hamburger"></span> <span>Viewing all posted requests </span> 

					<span class="col-lg-offset-2" >
						<form method="POST" style="display: inline;" action="/search_result" id="frm_search">
									{{csrf_field()}}
									<input type="text" name="search_field" class="form-control" id="search_control" placeholder="Search a request by category,  by request title">
							     
							       <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							     
						</form>
					</span>
							
						     
				
						 
					</div>
					<div class="panel-body tbl_wrap">
						<div class="col-lg-3">
							<span class="badge">5</span> Request Sent
						</div>
						<div class="col-lg-3">
							<span class="badge">8</span> Total Views
						</div>

						<div class="col-lg-3">
							<span class="badge">2</span> Pending Requests
						</div>

						<div class="col-lg-2">
							<span class="badge">1</span> Replied
						</div>
						
						<div class="col-lg-12 mg_top">
							@include('partials.message_block')
							<div class="col-lg-12 ">
							@foreach($join as $each_request)
									<div class="each_request">
										<hr>
											<span class="txt_grey "><i class="fa fa-calendar"></i>  Posted @ : {{$each_request->created_at->toFormattedDateString()}}</span> <br>
											<b><h4> <a class="link" href="/view_each_request/{{$each_request->id}}">{{$each_request->request_title}}</a> {{$each_request->category->category_name}}  </b></h4>
											<div>
												<div style="display: inline-block; float: left; margin-right:10px;">
												<?php 
													$img = $each_request->user->user_image ;
													// var_dump($img); exit;
												?>
													<img title="{{$each_request->user->email}}" src='{{ asset("images/$img") }}' alt="{{$each_request->user->username}}" class="img-responsive text-left img-circle" width="50" height="50" alt="Image">	
												</div>
												<div>
													{{$each_request->body}}... <a class="" href="/view_each_request/{{$each_request->id}}">More</a> 
														<span class ="pull-right" >
															<a class="glyphicon glyphicon-pencil txt_grey" data-toggle="modal" href="#edit_modal{{$each_request->id}}"></a>
															<a class="glyphicon glyphicon-trash txt_grey" href="{{ route('post.delete', $each_request->id) }}"></a>			
														</span>	
												</div>
	 										</div>									
										</hr>
									</b>
										
										</div>
								@endforeach
							</div>
						</div>
					</div> <!-- end of panel -->
				</div>
										
									</div>

							</div>
			@endif

	
					
	</div>
@endsection