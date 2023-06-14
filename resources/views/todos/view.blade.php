@extends('admin.main')

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Candidate Profile</h1>
    <div class="d-none d-sm-inline-block">
      <a href="{!! url('/candidate') !!}" class="btn btn-sm btn-dark shadow-sm">
        <i class="fas fa-angle-double-left"> </i> Back
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">



        <div class="row">

          <div class="col-lg-3">
            <div class="card">
              <div class="card-head text-center">
                <h5 class="mt-1 border-bottom text-gray-900">Profile Picture</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <img src="{{ $candidate->image ? url('img/candidate/'.$candidate->image) : ($candidate->gender == 'Male' ? url('/img/undraw_profile.svg') : url('img/undraw_profile_3.svg')) }}" class="border w-100" alt="image" id="blah">
                      <div class="input-group mb-3">
                      </div>
                    </div>
                  </div>
                </div>	
              </div>
            </div>
  
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                      <h5 class="card-title mb-3">Candidate CV</h5>
                      @if($candidate->cv != '')
                      <div class="card my-1 shadow-none border">
                          <div class="p-2">
                              <div class="row align-items-center">
                                  <div class="col-auto">
                                      <div class="avatar-sm">
                                          <span class="avatar-title rounded">
                                              @if($candidate->cv != '')
                                              <i class="fas fa-file-pdf"></i>
                                              @else
                                              <i class="far fa-file"></i>
                                              @endif
                                          </span>
                                      </div>
                                  </div>
                                  
                                  <div class="col pl-0">
                                      <a href="{!! url('candidate/' . $candidate->id . '/downloadcv') !!}" class="text-muted font-weight-bold">{{$candidate->name}}'s CV</a>
                                      {{-- <p class="mb-0">2.3 MB</p> --}}
                                  </div>
                                  <div class="col-auto">
                                      <!-- Button -->
                                      <a href="{!! url('candidate/' . $candidate->id . '/downloadcv') !!}" class="btn btn-link btn-lg text-muted">
                                          <i class="dripicons-download"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      @else
                        <div class="card my-1 shadow-none border">
                          <div class="p-2">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <div class="avatar-sm">
                                  <span class="avatar-title rounded">
                                    @if($candidate->cv != '')
                                    <i class="fas fa-file-pdf"></i>
                                    @else
                                    <i class="far fa-file"></i>
                                    @endif
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif
                  </div>
              </div>
              </div>
            </div>
          </div>

          <div class="col-lg-8">

            <div class="card">
              <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-primary">Candidate Profile</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Candidate Name: </label> <label style="color: darkblue">{{ $candidate->name }}</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label>Birth Date: </label> <label style="color: darkblue">{{ date("d-F", strtotime($candidate->birth_date)) }}</label>
                  </div>
                </div>
    
                <div class="form-group row">
    
                  <div class="col-sm-6">
                    <label>Apply for Position: </label> <label style="color: darkblue">{{ $candidate->position }}</label>
                  </div>
    
                  <div class="col-sm-6">
                    <label>Gender: </label> <label style="color: darkblue">{{ $candidate->gender }}</label>
                  </div>
    
                </div>
    
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label>Phone Number: </label> <label style="color: darkblue">{{ $candidate->phone }}</label>
                  </div>
                  <div class="col-sm-6">
                    <label>Email: </label> <label style="color: darkblue">{{ $candidate->email }}</label>
                  </div>
                </div>
    
                <div class="form-group row">
                  <div class="col-sm-6">
                    
                  </div>
                  <div class="col-sm-6">
                    <label>Apply Date: </label> <label style="color: darkblue">{{ date("d-F", strtotime($candidate->apply_date)) }}</label>
                  </div>
                </div>
    
                <div class="form-group row">
                  <div class="col-lg-12">
                    <label for="" class="m-0">Address:</label>
                    <h6 style="color: darkblue">{{ $candidate->address }}</h6>
                  </div>
                </div>
              </div>
            </div>

          </div>
          
        </div>
    </div>
  </div>

</div>



<script>
  function readURL(input) 
	{
  	if (input.files && input.files[0]) 
		{
    var reader = new FileReader();
    
    reader.onload = function(e) 
		{
      $('#blah').attr('src', e.target.result);
      
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  	}
	}
  $("#txtFile").change(function() {
    readURL(this);
  });
</script>
@endsection