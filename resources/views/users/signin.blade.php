@extends('layouts.master')

@section('title')
	WELCOME TO SIGNIN PAGE
@endsection

@include('partials.header')

@section('content')
<style type="text/css">
		body{
				background-image: url("{{ asset('/images/office2.jpeg') }}");
			}
</style>	
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 col-md-5 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-2">
				<div class="well first_content">
					@if(count($errors) > 0) <!-- the $errors get all errors in the validation class used in the controller also the count function get all number of errors as soon as it increases so basically count get the number of messages in the default ViewErrorBag -->
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								@foreach($errors->all() as $error)
									<strong>Error on Login-in..</strong> 
									<li>
										{{ $error }}
									</li> 
								@endforeach
							</div>
						@endif
					
								<center>
									<h1 class="txt_white">Sign In</h1>
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
									<button type="submit" class="btn btn-primary">Signin</button> <a class="txt_white" href="/forgot_password"> Forgot password? </a>

								</form>
							
				</div>
		</div>		
	</div>
@endsection