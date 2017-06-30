@extends('layouts.master')

@section('title')
	WELCOME TO SIGNUP PAGE
@endsection

@include('partials.header')
@section('content')
	
	<style type="text/css">
		body{
				background-image: url("{{ asset('/images/office2.jpeg') }}");
				/*background-repeat: no-repeat;*/
				
			}
</style>	

	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
				<div class="well" style="margin-top: 50px;">
					@include('partials.message_block')
					@if(count($errors) > 0) <!-- the $errors get all errors in the validation class used in the controller also the count function get all number of errors as soon as it increases so basically count get the number of messages in the default ViewErrorBag -->
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								@foreach($errors->all() as $error)
									<strong>Error Upon Submission...</strong> {{ $error }}
								@endforeach
							</div>
						@endif


					
								<center>
									<h1 class="txt_white">Sign Up!</h1>
								</center>
								<form action="" method="POST">
								{{ csrf_field() }}

									<div class="form-group">
										<label for="password" class="txt_white"> Email:</label>
										<input type="email" class="form-control" name="email" id="email">
									</div>

									<div class="form-group">
										<label for="password" class="txt_white"> Password:</label>
										<input type="password" class="form-control" name="password" id="password">
									</div>

									<div class="form-group">
										<label for="password" class="txt_white"> Department:</label>
										<select name="department" id="input" class="form-control" required="required">
											<option value="">Select Department</option>
											<option value="1">Account Department</option>
											<option value="2">Business Department</option>
											<option value="3">Tech Department</option>
											<option value="4">Marketing Department</option>
											<option value="5">Law Department</option>
										</select>
									</div>

									<div class="form-group">
										<label for="password" class="txt_white"> Gender:</label>
										<select name="gender" id="input" class="form-control" required="required">
											<option value="">Select Gender</option>
											<option value="Male">Male</option>
											<option value="Female">Female </option>
										</select>
									</div>



									<button type="submit" class="btn btn-primary">Signup</button> <a class="txt_white" href="{{ route('index') }}"> Already have an account.. Login </a>

								</form>
							
				</div>
		</div>		
	</div>
@endsection