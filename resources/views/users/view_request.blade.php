@if($current_user_role === 1)
	@include('partials.admin')
@else
@extends('layouts.master')

@include('partials.header')

@section('content')

		<div class="row">
				<div class="col-lg-2">
						<div class="panel panel-default bg_gray">
							<div class="panel-heading">
								<h3 class="panel-title"> <i class="fa fa-tachometer" aria-hidden="true"></i> Actions</h3>
							</div>
							<div class="panel-body">
								<li> <a href=""> <i class="fa fa-arrow-right" aria-hidden="true"></i> See all posts  </a> </li>
								<hr>
								<li> <a href=""><i class="fa fa-arrow-right" aria-hidden="true"></i> Accepted Request</a>  </li>
								<hr>
								<li> <a href=""><i class="fa fa-arrow-right" aria-hidden="true"></i> Rejected Request</a>  </li>
								<hr>
								<li> <a href=""><i class="fa fa-arrow-right" aria-hidden="true"></i>Deleted Request <span class="badge">5</span> </a>  </li>
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
						<div class="panel-body tbl_wrap" style="">
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
							
							<div class="col-lg-12 mg_top" >
								@include('partials.message_block')
								<div class="col-lg-12 ">

									@foreach($all_request as $each_request)
										<div class="each_request">
											<hr>
												<span class="txt_grey "><i class="fa fa-calendar"></i>  Posted @ : {{$each_request->created_at->toFormattedDateString()}} <small style="color:#337ab7"> 
												@if($current_user_mail != $each_request->user->email)
													{{$each_request->user->email}}:
												@else
													{{ "Me:" }}
												@endif
												</small>

												 </span> <br>
												<b><h4> <a class="link" href="/view_each_request/{{$each_request->id}}">{{$each_request->request_title}}</a> {{$each_request->category->category_name}}  </b></h4>
												<div>
													<div style="display: inline-block; float: left; margin-right:10px;">
													<?php 
														$img = $each_request->user->user_image ;
														// var_dump($img); exit;
													?>
														<img title="{{$each_request->user->username}}" src='{{ asset("images/$img") }}' alt="{{$each_request->user->username}}" class="img-responsive text-left img-circle" width="50" height="50" alt="Image">	
													</div>
													<div>
														{{$each_request->body}}... <a class="" href="/view_each_request/{{$each_request->id}}">More</a> 
															
															@if($current_user_mail != $each_request->user->email)
																<i style="color: #777;" class="fa fa-thumbs-up" aria-hidden="true"></i>0
																<i style="color: #777;" class="fa fa-thumbs-down" aria-hidden="true"></i>1

															@else
																<span class ="pull-right" >
																	
																	<a class="glyphicon glyphicon-pencil txt_grey" data-toggle="modal" href="#edit_modal{{$each_request->id}}"></a>
																	<a class="glyphicon glyphicon-trash txt_grey" href="{{ route('post.delete', $each_request->id) }}"></a>			
																</span>	
															@endif
															
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

				</div> <!--end of end of col-lg-8-->
				<div class="col-lg-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"> <i class="fa fa-tachometer" aria-hidden="true"></i> Categories</h3>
							</div>
							<div class="panel-body">
								@foreach($categories as $category)
									<li> <a href="{{url('view_request_category/'.$category->id)}}"> <i class="fa fa-arrow-right" aria-hidden="true"></i> {{$category->category_name}}</a> </li>
									<hr>
								@endforeach
								
								
							</div>
						</div>
				</div>

				<div class="col-lg-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"> <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i>  Monthly Post</i> </h3>
							</div>
							<div class="panel-body">
								
									<li> <a href="">
										 <i class="fa fa-arrow-right" aria-hidden="true"></i> January </i>
									</a> </li>
									<hr>
									<li> <a href="">
										<i class="fa fa-arrow-right" aria-hidden="true"></i> February </i>
									</a> </li>
									<hr>
									<li> <a href="">
										<i class="fa fa-arrow-right" aria-hidden="true"></i> March</i>
									</a> </li>
									<hr>
									<li> <a href="">
										<i class="fa fa-arrow-right" aria-hidden="true"></i> April
									</a> </li>
									<hr>
									<li> <a href="">
										<i class="fa fa-arrow-right" aria-hidden="true"></i> May
									</a> </li>
									<hr>
								
							</div>
						</div>
				</div>

		</div> <!--end of row-->
	@endsection()
	<!-- <a class="btn btn-primary" data-toggle="modal" href='#edit_modal'>Trigger modal</a> -->

	@foreach($all_request as $each_request)
	<div class="modal fade" id="edit_modal{{$each_request->id}}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" > <span id="md_title">Edit Request</span>  <small id="edit_icon">	<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
							<span class="sr-only">Loading...</span> </small>
						</h4>
					</center>
					@if(count($errors) > 0) <!-- the $errors get all errors in the validation class used in the controller also the count function get all number of errors as soon as it increases so basically count get the number of messages in the default ViewErrorBag -->
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									@foreach($errors->all() as $error)
										<strong>Error Upon Submission...</strong> {{ $error }} 
									@endforeach
								</div>
					@endif
				</div>
				<div class="modal-body" id="edit_form_modal">
					<form action="/view_edit_request" method="POST">
									{{ csrf_field() }}
								<div class="form-group">
									
								</div>
								<div class="form-group">
									<label >Request Type</label>
									<select name="category_id" id="category_id" class="form-control" required="required">
										<option value="4">Select type</option>
										@foreach($categories as $category)
											<option value="{{$category->id}}">{{$category->category_name}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="">Request Title</label>
									<input class="form-control" id="request_title" type="text" name="request_title" value="{{$each_request->request_title}}">				
								</div>
								<input class="form-control" type="hidden" name="id" value="{{$each_request->id}}">

								<input class="form-control" type="hidden" name="user_id" value="{{$user_id}}">
								<div class="form-group">
									<textarea class="form-control" name="body" id="request_body" VALUE ="" class="form-control" rows="3" placeholder="e.g The developer team is in need of a biro board marker" required="required">{{$each_request->body}}</textarea>
								</div>

								<div class="modal-footer">
									<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>

					</form>					
				</div>
			</div>
		</div>
	</div>@endforeach

	{{-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> --}}


	<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->
	<div class="modal fade" id="modal-new">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add New</h4>
				</div>
				<div class="modal-body">
					@if(count($errors) > 0) <!-- the $errors get all errors in the validation class used in the controller also the count function get all number of errors as soon as it increases so basically count get the number of messages in the default ViewErrorBag -->
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								@foreach($errors->all() as $error)
									<strong>An error occured while sending request...</strong> {{ $error }} 
								@endforeach
							</div>
					
					@endif
					<form action="/view_submit_request" method="POST">
									{{ csrf_field() }}
								<div class="form-group">
									<label >Request Type</label>
									<select name="category_id" id="category_id" class="form-control" required="required">
										<option value="4">Select type</option>
										@foreach($categories as $category)
											<option value="{{$category->id}}">{{$category->category_name}}</option>
										@endforeach
									</select>
									
									<input class="form-control" type="hidden" name="user_id" value="{{$user_id}}">
									<input class="form-control" type="hidden" name="user_image" value="{{$current_user_image}}">

								</div>
								<div class="form-group">
									<label class="">Request Title</label>
									<input class="form-control" type="text" name="request_title" value="">				
								</div>
								<div class="form-group">
									<textarea class="form-control" name="body" id="input" VALUE ="" class="form-control" rows="3" placeholder="e.g The developer team is in need of a biro board marker" required="required"></textarea>
								</div>

								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Submit Request <i class="fa fa-send-o"></i> </button>	
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>

					</form>				
				</div>
			
			</div>
		</div>
	</div>

@endif