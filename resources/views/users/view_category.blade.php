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
							<li> <a href="">See all posts  </a> </li>
							<hr>
							<li> <a href="">Accepted Request</a>  </li>
							<hr>
							<li> <a href="">Rejected Request</a>  </li>
							<hr>
							<li> <a href="">Error Request <span class="badge">5</span> </a>  </li>
						</div>
					</div>
			</div>

			<div class="col-lg-8">
				<div class="panel panel-default" id="panel_dashboard">
					<div class="panel-heading">
						<h3 class="panel-title"> <span class="glyphicon glyphicon-menu-hamburger"></span> Viewing all posted requests  <i id="plus_circle" class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i> <i id="minus_circle" class="fa fa-minus-circle" aria-hidden="true" style="float: right;"></i></h3>
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

								@foreach($all_request as $each_request)
									<div class="each_request">
										<hr>
											<span class="txt_grey "><i class="fa fa-inbox"></i>  Posted @ : {{$each_request->created_at->toFormattedDateString()}}</span> <br>
											<b><h4> <a class="link" href="/view_each_request/{{$each_request->id}}">{{$each_request->request_title}}</a>  (Stationery)</b></h4>
											<div> 
												<div style="display: inline-block; float: left; margin-right:10px;">
												<?php 
													$img = $each_request->user->user_image ;
													// var_dump($img); exit;
												?>
													<img src='{{ asset("images/$img") }}' class="img-responsive text-left img-circle" width="50" height="50" alt="Image">	
												</div>
												<div>
													{{$each_request->body}}... <a class="glyphicon glyphicon-eye-open" href="">More</a> 
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
			</div> <!--end of end of col-lg-8-->
			
			<div class="col-lg-2">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"> <i class="fa fa-tachometer" aria-hidden="true"></i> Categories</h3>
						</div>
						<div class="panel-body">
							@foreach($category as $categories)
								<li> <a href="view_category/{{$categories->id}}"> {{$categories->category_name}}</a> </li>
								<hr>
							@endforeach
							
							
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
					<h4 class="modal-title" >Edit Request</h4>
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
								<input class="form-control" type="text" name="request_type" value="{{$each_request->request_type}}">
							</div>
							<div class="form-group">
								<label class="">Request Title</label>
								<input class="form-control" type="text" name="request_title" value="{{$each_request->request_title}}">				
							</div>
							<input class="form-control" type="hidden" name="id" value="{{$each_request->id}}">

							<input class="form-control" type="hidden" name="user_id" value="{{$user_id}}">
							<div class="form-group">
								<textarea class="form-control" name="body" id="input" VALUE ="" class="form-control" rows="3" placeholder="e.g The developer team is in need of a biro board marker" required="required">{{$each_request->body}}</textarea>
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
				<h4 class="modal-title">Modal title</h4>
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
								<select name="request_type" id="inputRequest_type" class="form-control" required="required">
									<option value="">Select type</option>
									<option value="Stationary">Stationary</option>
									<option value="Shelter">Shelter</option>
									<option value="Food">Food</option>
									<option value="Others">Others</option>
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