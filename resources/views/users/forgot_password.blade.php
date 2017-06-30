@extends('layouts.master')

@include('partials.header')

@section('content')
	<div class="col-lg-5 col-lg-offset-4">
			
		<div class="form-group">
			<form method="POST" action="/forgot_password">
				{{ csrf_field() }}
				<label class="">Email Address</label>
				<input type="email" name="email" id="input" class="form-control" value="" required="required" title=""> <br>
				<div class="form-group">
						<button type="submit" class="btn btn-primary"> <i></i> Retrieve</button>	
				</div>
			</form>
		</div>
	</div>
@endsection