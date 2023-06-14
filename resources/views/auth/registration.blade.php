@extends('layout')

@section('content')
<main class="login-form">
  <div class="cotainer mt-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@include('common.errors')
				<div class="card">
					<div class="card-header">Register</div>
					<div class="card-body">

						<form action="{{ route('register.post') }}" method="POST">
							@csrf
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">Name: <span class="text-danger">*</span></label>
								<div class="col-md-6">
									<input type="text" id="name" class="form-control" name="name" required placeholder="Full Name" value="{{ old('name') }}">
									@if ($errors->has('name'))
										<span class="text-danger">{{ $errors->first('name') }}</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address: <span class="text-danger">*</span></label>
								<div class="col-md-6">
									<input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email Address">
									@if ($errors->has('email'))
										<span class="text-danger">{{ $errors->first('email') }}</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">Password: <span class="text-danger">*</span></label>
								<div class="col-md-6">
									<input type="password" id="password" class="form-control" name="password" value="{{ old('password') }}" required placeholder="Password">
									@if ($errors->has('password'))
										<span class="text-danger">{{ $errors->first('password') }}</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">Confirm Password: <span class="text-danger">*</span></label>
								<div class="col-md-6">
									<input type="password" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation"
									 required placeholder="Confirm Password">
									@if ($errors->has('password_confirmation'))
										<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="username" class="col-md-4 col-form-label text-md-right">Username: <span class="text-danger">*</span></label>
								<div class="col-md-6">
									<input type="text" id="username" class="form-control" name="username" value="{{ old('username') }}"  required placeholder="Username">
									@if ($errors->has('username'))
										<span class="text-danger">{{ $errors->first('username') }}</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="username" class="col-md-4 col-form-label text-md-right">Phone: <span class="text-danger">*</span></label>
								<div class="col-md-6">
									<input data-toggle="input-mask" data-mask-format="(000) 000-0000" value="{{ old('phone') }}" 
                  type="text" class="form-control @error('phone') border-danger @enderror m-0" 
                  name="phone" id="phone" placeholder="Phone Number" required>
                  @error('phone')
                    <label for="" class="text-danger">{{ $errors->first('phone') }}</label>
                  @enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="username" class="col-md-4 col-form-label text-md-right">Gender: <span class="text-danger">*</span></label>
								<div class="col-md-6">
									<select class="form-control select" name="gender" id="gender">
                    <option value="" hidden>-- Please Select Gender --</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected':'' }} >Female</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected':'' }}>Male</option>
                  </select>
                  @error('gender')
                    <label for="" class="text-danger">{{ $errors->first('gender') }}</label>
                  @enderror
								</div>
							</div>

							<div class="col-md-6 offset-md-4">
								<a href="{{ url('/login') }}" class="btn btn-dark">
									Back
								</a>
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
  </div>
</main>
@endsection
