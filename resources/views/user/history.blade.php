<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">

      <div class="row">
        <div class="col-lg-8">

          <div class="row">

            <div class="col-lg-12">
              <div class="form-group">
                <label for="" class="text-gray-900" >Name:</label>  <span style="color: darkblue"> {{ $user_history->name }}</span>
              </div>                
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label for="" class="text-gray-900" >Username:</label>  <span style="color: darkblue"> {{ $user_history->username }}</span>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-12">
              <div class="form-group">
                <label for="" class="text-gray-900">Password:</label> <span style="color: darkblue"> {{ $user_history->password }}</span>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Phone Number:</label> <span style="color: darkblue"> {{ $user_history->phone }}</span>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Gender:</label> <span style="color: darkblue"> {{ $user_history->gender }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="" class="text-gray-900 m-0">Email:</label> <span style="color: darkblue"> {{ $user_history->email }}</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="text-gray-900">Address:</label> <br>
            <p style="color: darkblue">{{ $user_history->address }}</p>
          </div>

          <div class="form-group">
            <label for="" class="text-gray-900">Status:</label> 
            @if ($user_history->status == 1)
              <span style="color: darkblue">Active</span>
            @else
              <span style="color: red">In-Active</span>
            @endif
          </div>

        </div>

        <!-- tab Role -->
        <div class="col-lg-4">
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
                        <img src="{{ $user_history->image ? url('img/user/'.$user_history->image) : ($user_history->gender == 'Male' ? url('/img/undraw_profile.svg') : url('img/undraw_profile_3.svg')) }}" class="border w-100" alt="image" id="blah">
                      </div>
                    </div>
                  </div>	
                </div>
              </div>
            </div>

            <!-- Role -->
            <div class="col-lg-12">
              <div class="form-group">
                <label for="">Choose Role:</label> <span style="color: darkblue"> {{ $user_history->role }}</span>
              </div>
            </div>

          </div>
        </div>
        
      </div>

    </div>
  </div>
</div>