@extends('admin.main')

@section('head')
<title>Update Your Info</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0">Update your information</h1>
</div>
{!! Form::model($user , array('route' => array('userinfo.update', $user->id), 'method'=>'PUT', 'files' => 'true', 'autocomplete' => 'off')) !!}
@csrf
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-9">
        <div class="container">

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0" >Name:</label>  <span class="text-danger">*</span>
                <input value="{{ old('name') ? old('name') : $user->name }}" type="text" placeholder="Name" autocomplete="off"
                class="form-control @error('name') border-danger @enderror" name="name" id="name">
                @error('name')
                  <label for="" class="text-danger">{{ $errors->first('name') }}</label>
                @enderror
              </div>                
            </div>
            
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Old Password:</label> <span class="text-danger">*</span>
                <input name="oldpassword" value="{{ old('oldpassword') }}" type="password"
                  class="form-control @error('oldpassword') border-danger @enderror" placeholder="Old Password">
                @error('oldpassword')
                <label for="" class="text-danger">{{ $errors->first('oldpassword') }}</label>
                @enderror
                @if($erorroldpassword != '')
                <label for="" class="text-danger">{{ $erorroldpassword }}</label>
                @endif
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-6">

              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Password:</label> <span class="text-danger">*</span>
                <input name="password" value="{{old('password')}}" type="password"
                  class="form-control @error('password') border-danger @enderror" placeholder="Password">
                @error('password')
                <label for="" class="text-danger">{{ $errors->first('password') }}</label>
                @enderror
              </div>

            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Repeat Password:</label> <span class="text-danger">*</span>
                <input name="password_confirmation" value="{{old('password_confirmation')}}" type="password"
                  class="form-control @error('password_confirmation') border-danger @enderror"
                  placeholder="Repeat Password">
                @error('password_confirmation')
                <label for="" class="text-danger">{{ $errors->first('password_confirmation') }}</label>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Phone Number:</label><span class="text-danger">*</span>
                <input data-toggle="input-mask" data-mask-format="(000) 000-0000" type="text" readonly style="cursor: not-allowed"
                value="{{ old('phone') ? old('phone') : $user->phone }}" 
                 class="form-control @error('phone') border-danger @enderror m-0" 
                name="phone" id="phone" placeholder="Phone Number">
                @error('phone')
                  <label for="" class="text-danger">{{ $errors->first('phone') }}</label>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Gender:</label><span class="text-danger">*</span>
                <select class="form-control select" name="gender" id="gender">
                  <option value="" hidden>-- Please Select Gender --</option>
                  @if (old('gender'))
                  <option value="Female" {{ old('gender') == 'Female' ? 'selected':'' }} >Female</option>
                  <option value="Male" {{ old('gender') == 'Male' ? 'selected':'' }} >Male</option>
                  @else
                  <option value="Female" {{ $user->gender == 'Female' ? 'selected':'' }} >Female</option>
                  <option value="Male" {{ $user->gender == 'Male' ? 'selected':'' }} >Male</option>
                  @endif
                </select>
                @error('gender')
                  <label for="" class="text-danger">{{ $errors->first('gender') }}</label>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Username:</label> <span class="text-danger">*</span>
                <input name="username" value="{{$user->username}}" type="text"
                  class="form-control @error('username') border-danger @enderror" placeholder="Username" readonly
                  style="cursor: not-allowed;">
                @error('username')
                <label for="" class="text-danger">{{ $errors->first('username') }}</label>
                @enderror
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Email:</label><span class="text-danger">*</span>
                <input value="{{ old('email') ? old('email') : $user->email }}" type="email" class="form-control @error('email') border-danger @enderror m-0" name="email" id="email" placeholder="Email Address" required>
                @error('email')
                  <label for="" class="text-danger">{{ $errors->first('email') }}</label>
                @enderror
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Address:</label>
                <textarea name="address" class="form-control @error('address') border-danger @enderror" id="address" cols="30" rows="5" placeholder="Address">{{ old('address') ? old('address') : $user->address }}</textarea>
                @error('address')
                  <label for="" class="text-danger">{{ $errors->first('address') }}</label>
                @enderror
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="col-lg-3">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-head text-center">
                <header class="mt-1 border-bottom text-gray-900">Profile Image</header>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <img src="{{ $user->image ? url('img/user/'.$user->image) : ($user->gender == 'Male' ? url('/img/undraw_profile.svg') : url('img/undraw_profile_3.svg')) }}" class="border w-100" alt="image" id="blah">
                      <div class="input-group mb-3">
                        <input type="file" class="form-control" id="txtFile" style="cursor: pointer;" name="image" accept=".jpg,.png,.jpeg">
                      </div>
                    </div>
                  </div>
                </div>	
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <a href="{!! url('/user') !!}" class="btn btn-secondary">Back</a>
  {!! Form::submit('Update',array('class'=> 'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
@endsection

@section('javascript')
  <script>
  function readURL(input) 
	{
  	if (input.files && input.files[0]) 
		{
    var reader = new FileReader();
    
    reader.onload = function(e) 
		{
      $('#blah').attr('src', e.target.result);
			// $('#lblImg').text(input.files[0]);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  	}
	}
  $("#txtFile").change(function() {
    readURL(this);
  });

  </script>
@endsection