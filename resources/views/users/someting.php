@extends('layouts.master')
@extends('partials.header')
@section('content')
	<div class="row first_content">
		<div class="col-md-12">
			<center>
				<h1>Moderate Profile</h1>
			</center>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
				@if(!$join)
						<div class="row">
							<h1>NO RESULT FOUND!</h1>
						</div>
					@else
						<div class="row">
							<h1>YOU JUST QUERY SOMETHING</h1>
						</div>
					@endif

		</div>
					
	</div>
@endsection