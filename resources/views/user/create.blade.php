@extends('admin.main')

@section('head')
<title>Create User</title>
@endsection

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Create User</h1>
  </div>
  <div class="row">
    <div class="col-lg-12">
      
      {!! Form::open(array('url'=>'user', 'files'=>'true')) !!}
        @csrf
        <div class="row">
          <div class="col-lg-9">

            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="" class="text-gray-900" >Name:</label>  <span class="text-danger">*</span>
                  <input value="{{ old('name') }}" type="text" placeholder="Name" autocomplete="off"
                  class="form-control @error('name') border-danger @enderror" name="name" id="name">
                  @error('name')
                    <label for="" class="text-danger">{{ $errors->first('name') }}</label>
                  @enderror
                </div>                
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="" class="text-gray-900" >Username:</label>  <span class="text-danger">*</span>
                  <input value="{{ old('username') }}" type="text" placeholder="Username" autocomplete="off"
                  class="form-control @error('username') border-danger @enderror" name="username" id="username">
                  @error('username')
                    <label for="" class="text-danger">{{ $errors->first('username') }}</label>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-6">
                <div class="form-group">
                  <label for="" class="text-gray-900">Password:</label> <span class="text-danger">*</span>
                  <input name="password" value="{{old('password')}}" type="password" class="form-control @error('password') border-danger @enderror" placeholder="Password">
                  @error('password')
                    <label for="" class="text-danger">{{ $errors->first('password') }}</label>
                  @enderror
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="" class="text-gray-900">Repeat Password:</label> <span class="text-danger">*</span>
                  <input name="password_confirmation" value="{{old('password_confirmation')}}" type="password" class="form-control @error('password_confirmation') border-danger @enderror" placeholder="Repeat Password">
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
                  <input data-toggle="input-mask" data-mask-format="(000) 000-0000" value="{{ old('phone') }}" 
                  type="text" class="form-control @error('phone') border-danger @enderror m-0" 
                  name="phone" id="phone" placeholder="Phone Number" required>
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
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected':'' }} >Female</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected':'' }}>Male</option>
                  </select>
                  @error('gender')
                    <label for="" class="text-danger">{{ $errors->first('gender') }}</label>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="" class="text-gray-900 m-0">Email:</label><span class="text-danger">*</span>
                  <input value="{{ old('email') }}" type="email" class="form-control @error('email') border-danger @enderror m-0" name="email" id="email" placeholder="Email Address" required>
                  @error('email')
                    <label for="" class="text-danger">{{ $errors->first('email') }}</label>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="text-gray-900">Address:</label>
              <textarea name="address" class="form-control @error('address') border-danger @enderror" id="address" cols="30" rows="5" placeholder="Address">{{ old('address') }}</textarea>
              @error('address')
                <label for="" class="text-danger">{{ $errors->first('address') }}</label>
              @enderror
            </div>

            <div class="form-group">
              <label class="switch">
                <input type="checkbox" name="status" id="status" checked {{(old('status')== '1')? 'checked':''}}>
                <span class="slider round"></span>
              </label>
            </div>

          </div>

          <!-- tab Role -->
          <div class="col-lg-3">
            <div class="row">

              {{-- Image --}}
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-head text-center">
                    <header class="mt-1 border-bottom text-gray-900">Profile Image</header>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <img src="{!! url('/img/icon/default-user-image.png') !!}" class="border w-100" alt="image" id="blah">
                          <div class="input-group mb-3">
                            <input type="file" class="form-control" id="txtFile" style="cursor: pointer;" name="image" accept=".jpg,.png,.jpeg">
                          </div>
                        </div>
                      </div>
                    </div>	
                  </div>
                </div>
              </div>

              <!-- Role -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="">Choose Role:</label> <span class="text-danger">*</span>
                  <br>
                  <div class="form-check form-radio-danger" id="roles">
                    
                  </div>
                  @error('role_id')
                    <label for="" class="text-danger">{{ $errors->first('role_id') }}</label>
                  @enderror
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="modal-footer">
          <a href="{!! url('/user') !!}" class="btn btn-secondary">Back</a>
          {!! Form::submit('Create',array('class'=> 'btn btn-primary')) !!}
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

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

  checkedRole();
  function checkedRole()
  {
    var role = $('#roles');
    var radio="";
    $.ajax({
      type: 'GET',
      url: '{!! URL::to("roleDynamic") !!}',
      // data: {'branch_id' : branch_id},
      success:function(data)
      {
        // op+='<option value="" hidden>-- Select Department --</option>';
        for(var i=0;i<data.length;i++)
        {
          if(data[i].id == 1)
          { continue; }
          radio+='<input type="radio" name="role_id" class="form-check-input" value="'+data[i].id+'" id="'+data[i].role_name+'"> ';
          radio+=' <label class="form-check-label" for="'+data[i].role_name+'"> '+data[i].role_name+'</label> <br>';
        }

        role.html(radio);

        console.log(data);
        
      },
      error:function()
      {

      }
    });
    
  }
</script>
@endsection