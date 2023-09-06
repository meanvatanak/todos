@extends('admin.main')

@section('head')

@endsection

@section('content')

<div class="container-fluid">
  
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Update Book</h1>
  </div>
  {!! Form::model($elibrary , array('route' => array('e-library.update', $elibrary->id), 'method'=>'PUT','files' => 'true', 'autocomplete' => 'off')) !!}
  @csrf
  @include('common.errors')
  <div class="row">
    <div class="col-lg-3">
      <div class="card">
        <div class="card-head text-center">
          <header class="mt-1 border-bottom text-gray-900">Book's Cover</header>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <img src="{!!  $elibrary->book_cover ? url('/img/e_library/'.$elibrary->book_cover) : url('/img/icon/book-cover.jpg') !!}" class="border w-100" alt="image" id="blah">
                <div class="input-group mb-3">
                  <input type="file" class="form-control" id="txtFile" style="cursor: pointer;" value="{{ old('book_cover') ? old('book_cover') : $elibrary->book_cover }}" name="book_cover" accept=".jpg,.png,.jpeg">
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
                <h5 class="card-title mb-3">Book's File</h5>
                <label for="" class="m-0 text-danger">Only PDF file</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" value="{{ old('book_file') ? old('book_file') : $elibrary->book_file }}" class="form-control" id="book_file" style="cursor: pointer;" name="book_file" accept=".pdf">
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9">

      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Title:</label> <span class="text-danger">*</span>
            <input type="text" value="{{ old('title') ? old('title') : $elibrary->title  }}" name="title" id="title" required
              class="form-control @error('title') border-danger @enderror" placeholder="Title">
            @error('title')
            <label for="" class="text-danger">{{ $errors->first('title') }}</label>
            @enderror
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Year:</label> <span class="text-danger">*</span>
            <input type="text" value="{{ old('year') ? old('year') : $elibrary->year }}" name="year" id="year" required
              class="form-control @error('year') border-danger @enderror" placeholder="Year">
            @error('year')
            <label for="" class="text-danger">{{ $errors->first('year') }}</label>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Page:</label> <span class="text-danger">*</span>
            <input type="text" value="{{ old('page') ? old('page') : $elibrary->page }}" name="page" id="page" required 
              class="form-control @error('page') border-danger @enderror" placeholder="Page">
            @error('page')
            <label for="" class="text-danger">{{ $errors->first('page') }}</label>
            @enderror
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Author:</label> <span class="text-danger">*</span>
            <select name="author_id" id="author_id" class="form-control m-0 select2" data-toggle="select2">
              <option value="">-- Select Author --</option>
              @foreach($authors as $author)
              <option value="{{ $author->id }}" {{ ( old('author_id') == $author->id ) || ( $elibrary->author_id == $author->id ) ? 'selected':'' }}>{{ $author->name }}</option>
              @endforeach
            </select>
            @error('author_id')
            <label for="" class="text-danger">{{ $errors->first('author_id') }}</label>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Publisher:</label> <span class="text-danger">*</span>
            <select name="publisher_id" id="publisher_id" class="form-control m-0 select2" data-toggle="select2">
              <option value="">-- Select Publisher --</option>
              @foreach($publishers as $publisher)
              <option value="{{ $publisher->id }}" {{ (old('publisher_id') == $publisher->id) || ( $elibrary->publisher_id == $publisher->id ) ? 'selected':'' }}>{{ $publisher->name }}</option>
              @endforeach
            </select>
            @error('publisher_id')
            <label for="" class="text-danger">{{ $errors->first('publisher_id') }}</label>
            @enderror
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Genre:</label> <span class="text-danger">*</span>
            <select name="genre_id" id="genre_id" class="form-control m-0 select2" data-toggle="select2">
              <option value="">-- Select Genre --</option>
              @foreach($genres as $genre)
              <option value="{{ $genre->id }}" {{ (old('genre_id') == $genre->id) || ( $elibrary->genre_id == $genre->id ) ? 'selected':'' }}>{{ $genre->name }}</option>
              @endforeach
            </select>
            @error('genre_id')
            <label for="" class="text-danger">{{ $errors->first('genre_id') }}</label>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label for="">Sub Title:</label>
            <textarea class="form-control" name="sub_title" id="sub_title" cols="30" rows="10"
            placeholder="Sub Title">{{ old('sub_title') ? old('sub_title') : $elibrary->sub_title }}</textarea>
            @error('sub_title') 
            <label for="" class="text-location">{{ $errors->first('sub_title') }}</label>
            @enderror
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label class="switch">
          <input type="checkbox" name="status" id="status" checked {{ (old('status') == '1') || ( $elibrary->status == '1' ) ? 'checked':''}} >
          <span class="slider round"></span>
        </label>
      </div>
    </div>
  </div>
  
  <div class="modal-footer">
    <a href="{!! url('/e-library') !!}" class="btn btn-secondary">Back</a>
    {!! Form::submit('Update',array('class'=> 'btn btn-primary')) !!}
  </div>
  {!! Form::close() !!}
</div>

@endsection

@section('javascript')
<script>
  $(document).ready(function (){
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
  
    var branch_id = $('#branch_id').val();
    selectEmp(branch_id);
    
    $(document).on('change','#branch_id',function(){
      branch_id = $(this).val();
      selectEmp(branch_id);
    });
  
    function selectEmp(branch_id)
    {
      var employees = $('#employees');
      var op="";
      $.ajax({
        type: 'GET',
        url: '{!! URL::to("empDynamic") !!}',
        data: {'branch_id' : branch_id},
        success:function(data)
        {
          op+='<option value="">-- Please Select Person In Charge --</option>';
          for(var i=0;i<data.length;i++)
          {
            if(data[i].id == 1)
            { continue; }
            if(data[i].active == 0 || data[i].delete_status == 1)
            { continue; }
            op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
          }
          $('#person_in_charge_id').html(op);
          if($('#old_person_in_charge_id').val() != "")
          {
            $('#person_in_charge_id').val($('#old_person_in_charge_id').val());
            // $('#person_in_charge_id').select2().val($('#old_person_in_charge_id').val()).trigger('change');
          }
        },
        error:function()
        {
  
        }
      });
      
    }
  });
</script>
@endsection