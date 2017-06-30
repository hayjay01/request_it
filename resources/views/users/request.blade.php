@extends('layouts.master')
@include('partials.header')
@section('content')
	
	<div class="well first_content">
		@if(count($errors) > 0) <!-- the $errors get all errors in the validation class used in the controller also the count function get all number of errors as soon as it increases so basically count get the number of messages in the default ViewErrorBag -->
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					@foreach($errors->all() as $error)
						<strong>An error occured while sending request...</strong> {{ $error }} 
					@endforeach
				</div>
		
		@endif
		<div class="row">
			<div class="col-lg-5 col-lg-offset-4">
				<form action="" method="POST" >
				{{ csrf_field() }}
					<div class="form-group">
						<label class=""> Request Title: </label>
						<input type="text" placeholder="e.g marker" class="form-control" name="request_title">
					</div>

					<div class="form-group">
						<label class=""> Request Type: </label>
						<select name="request_type" id="inputRequest_type" class="form-control" required="required">
							<option value="">Select type</option>
							<option value="Stationary">Stationary</option>
							<option value="Shelter">Shelter</option>
							<option value="Food">Food</option>
							<option value="Others">Others</option>
						</select>
					</div>

					<div class="form-group">
						<textarea name="body" id="input" class="form-control" rows="3" placeholder="e.g The developer team is in need of a biro board marker" required="required"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Submit Request <i class="fa fa-send-o"></i> </button>
				</form>
			</div>
		</div>
		
	</div>
@endsection