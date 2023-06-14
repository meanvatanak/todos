@extends('frontend.main')

@section('style')
  <title>Update Todos</title>
@endsection

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Update Todos</h1>
  </div>
  <div class="row">
    <div class="col-lg-12">
      
      {!! Form::model($todo , array('route' => array('todos.update', $todo->id), 'method'=>'PUT','files' => 'true', 'autocomplete' => 'off')) !!}
      @csrf
      {{-- @include('common.errors') --}}

        <div class="row">

          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="" class="m-0">Task Name:</label> <span class="text-danger">*</span>
                  <input value="{{ old('name') ? old('name') : $todo->name }}" type="text" name="name" id="name"
                  class="form-control @error('name') border-danger @enderror" placeholder="Document Name" >
                  @error('name')
                    <label for="" class="text-danger">{{ $errors->first('name') }}</label>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="from-group">
                  <label for="" class="m-0">Due Date</label> <span class="text-danger">*</span>
                  <input value="{{ old('due_date') ? old('due_date') : date('Y-m-d', strtotime($todo->due_date)) }}" name="due_date" type="date" data-provide="datepicker" data-date-autoclose="true" 
                  data-date-format="d-M-yyyy" data-date-container="#datepicker" placeholder="Due Date"
                  class="text-gray-900 form-control put_required @error('birth_date') border-danger @enderror">
                  @error('due_date')
                    <label for="" class="text-danger">{{ $errors->first('due_date') }}</label>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        
        </div>

        <div class="row">
          
          <div class="col-lg-12">
            <div class="form-group">
              <label for="" class="text-gray-900 m-0">Descriptions: </label>
              <textarea name="description" id="description" cols="30" rows="8" placeholder="Description" style="white-space: pre-wrap;"
              class="form-control @error('description') border-danger @enderror">{{ old('description') ? old('description') : $todo->description }}</textarea>
              @error('description')
                <label for="" class="text-danger">{{ $errors->first('description') }}</label>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="form-group mt-3">
              <label class="switch">
                <input type="checkbox" name="status" id="status" {{ $todo->status == 1 ? 'checked' : '' }}>
                <span class="slider round"></span>
              </label>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <a href="{!! url('/todos') !!}" class="btn btn-secondary">Back</a>
          {!! Form::submit('Update',array('class'=> 'btn btn-primary')) !!}
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('script_front')
@endsection