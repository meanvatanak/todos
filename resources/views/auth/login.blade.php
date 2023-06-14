@extends('layout')

@section('content')

<div class="auth-fluid">
  <!--Auth fluid left content -->
  <div class="auth-fluid-form-box">
    <div class="align-items-center d-flex h-100">
			<div class="card-body">

				<!-- Logo -->
				<div class="auth-brand text-center text-lg-start">
					<a href="{!! url('/dashboard') !!}" class="logo-dark">
						<span><img src="{{ URL::asset('img/logo/logo-long.png') }}" alt="" height="100"></span>
					</a>
				</div>

				<!-- title-->
				
				{{-- <h4 class="mt-0">Quanum Spectrum</h4> --}}
				<br>
				<br>
				<br>
				@include('common.errors')
				<h4 class="mt-0">Sign In</h4>
				<!-- form -->
				<form class="user" action="{{ route('login.post') }}" method="get">
					@csrf
					<div class="mb-3">
						<label for="emailaddress" class="form-label">Username</label>
						<input type="text" class="form-control" id="username" name="username"
						placeholder="Enter Username...">
						@error('username')
							<label for="" class="text-danger m-0">{{ $errors->first('username') }} </label>
						@enderror
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
						@error('password')
							<label for="" class="text-danger">{{ $errors->first('password') }}</label>
						@enderror
					</div>
					<div class="mb-3">
					</div>
					<div class="d-grid mb-0 text-center">
						<button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In </button>
					</div>
				</form>
				<!-- end form-->

			</div> <!-- end .card-body -->
    </div> <!-- end .align-items-center.d-flex.h-100-->
</div>
  <!-- end auth-fluid-form-box-->

  <!-- Auth fluid right content -->
  <div class="auth-fluid-right text-center" style="background-image: url({{ url('/assets/images/bg-auth4.jpg') }}); background-size: cover; background-repeat: no-repeat" >
  {{-- <div class="auth-fluid-right text-center"> --}}
		<div class="font-12 auth-user-testimonial">
			<p> Developed by Mean Vatanak </p>
		</div>
  <!-- end auth-user-testimonial-->
  </div>
  <!-- end Auth fluid right content -->
</div>

</div>

@endsection