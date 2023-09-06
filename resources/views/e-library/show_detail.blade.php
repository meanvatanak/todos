<div class="row">
  <div class="col-lg-12">
    
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="">Title:</label> <span class="text-primary">{{ $elibrary_history->title }}</span>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="">Year:</label> <span class="text-primary" >{{ $elibrary_history->year }}</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="">Page:</label> <span class="text-primary" >{{ $elibrary_history->page }}</span>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="">Author:</label> <span class="text-primary" >{{ $elibrary_history->author }}</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="">Publisher:</label> <span class="text-primary" >{{ $elibrary_history->publisher }}</span>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="">Genre:</label> <span class="text-primary" >{{ $elibrary_history->genre }}</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label for="">Sub Title:</label>
          <p class="text-gray-900" style="white-space: pre-wrap; font-size: 16px;">{{ $elibrary_history->sub_title }}</p>
        </div>
      </div>
    </div>

    <div class="form-group">
      @if ($elibrary_history->status == 1)
        <label for="">Status:</label> <span class="badge bg-success">Active</span>
      @else
        <label for="">Status:</label> <span class="badge bg-danger">In-Active</span>
      @endif
    </div>
    
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-head text-center">
        <header class="mt-1 border-bottom text-gray-900">Book's Cover</header>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <img src="{!!  $elibrary_history->book_cover ? url('/img/e_library/'.$elibrary_history->book_cover) : url('/img/icon/book-cover.jpg') !!}" class="border w-100" alt="image" id="blah">
            </div>
          </div>
        </div>	
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body p-2">
        <h5 class="card-title mb-3">Book's File</h5>
        @if($elibrary_history->book_file != '')
        <div class="card my-1 shadow-none border">
          <div class="p-1">
            <div class="row align-items-center">
              <div class="col-auto">
                <div class="avatar-sm">
                  <span class="avatar-title rounded">
                    @if($elibrary_history->book_file != '')
                    <i class="fas fa-file-pdf"></i>
                    @else
                    <i class="far fa-file"></i>
                    @endif
                  </span>
                </div>
              </div>
              
              <div class="col p-0">
                <a href="{!! url('/storage/book_file/' . $elibrary_history->book_file) !!}" style="font-size: 12px" class="text-muted font-weight-bold">{{$elibrary_history->title}}'s CV</a>
                {{-- <p class="mb-0">2.3 MB</p> --}}
              </div>
              <div class="col-auto p-0">
                <!-- Button -->
                <a href="{!! url('/storage/book_file/' . $elibrary_history->book_file) !!}" class="btn btn-link btn-lg text-muted">
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
                      @if($elibrary_history->book_file != '')
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

  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label for="">Action By</label> <label for="" style="font-family: Khmer OS Siemreap;">ការបញ្ចូលឫកែប្រែដោយ:</label> 
        <span class="text-primary" style="font-family: Khmer OS Siemreap;">
          @if ($elibrary_history->created_by)
            Created By {{ $elibrary_history->created_by ? $elibrary_history->created_by : '' }}
          @elseif($elibrary_history->updated_by)
            Updated By {{ $elibrary_history->updated_by ? $elibrary_history->updated_by : '' }}
          @elseif($elibrary_history->deleted_by)
            Deleted By{{ $elibrary_history->deleted_by ? $elibrary_history->deleted_by : '' }}
          @endif
        </span>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="form-group">
        <label for="">Action At</label> <label for="" style="font-family: Khmer OS Siemreap;">ការបញ្ចូលឫកែប្រែដោយ:</label> 
        <span class="text-primary" style="font-family: Khmer OS Siemreap;">
          @if ($elibrary_history->created_at)
            Created At {{ $elibrary_history->created_at ? date('d-M-Y H:s A', strtotime($elibrary_history->created_at)) : ''}}
          @elseif($elibrary_history->updated_at)
            Updated At {{ $elibrary_history->updated_at ? date('d-M-Y H:s A', strtotime($elibrary_history->updated_at)) : ''}}
          @elseif($elibrary_history->deleted_at)
            Deleted At {{ $elibrary_history->deleted_at ? date('d-M-Y H:s A', strtotime($elibrary_history->deleted_at)) : ''}}
          @endif
        </span>
      </div>
    </div>
  </div>