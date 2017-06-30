@extends('layouts.master')



	@section('content')
		
		<div class="row" style="margin-top: 300px;">
			<div class="col-lg-4 col-lg-offset-5">
				<div>
					<a href="{{ route('users.signup') }}" class="btn btn-primary">Get Started</a>
				</div>
			</div>			
		</div>
	@endsection

