@extends('admin.main')

@section('head')
<title>Create Role</title>
@endsection

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Create Role</h1>
  </div>
  <div class="row">
    <div class="col-lg-12">
      
      {!! Form::open(array('url'=>'role', 'files'=>'true')) !!}
      {{-- @csrf --}}
      <div class="row">
          <div class="col-lg-6">

            <div class="form-group">
              <label for="" class="text-gray-900" >Role Name:</label>
              <input value="{{ old('role_name') }}" type="text" class="form-control @error('role_name') border-danger @enderror" name="role_name" id="role_name"
                placeholder="Role Name" autocomplete="off">
              @error('role_name')
                <label for="" class="text-danger">{{ $errors->first('role_name') }}</label>
              @enderror
            </div>

            <div class="form-group">
              <label for="" class="text-gray-900">Remark:</label>
              <textarea name="remark" class="form-control @error('remark') border-danger @enderror" id="txtRemark" cols="30" rows="5" placeholder="Remark">{{ old('remark') }}</textarea>
              @error('remark')
                <label for="" class="text-danger">{{ $errors->first('remark') }}</label>
              @enderror
            </div>
            <div class="form-group">
              <label class="switch">
                <input type="checkbox" name="status" id="status" checked {{(old('status')== '1')? 'checked':''}}>
                <span class="slider round"></span>
              </label>
            </div>
          </div>

           <!-- tab Card Website -->
          <div class="col-lg-6">
            <label for="" class="text-gray-900 m-0">Permission:</label>

            <!-- tab Card User's Website -->
            <div class="accordion" id="accordionWebsite">
              <div class="card mb-0">
                <div class="card-header" id="headingWebsite">
                    <h6 class="m-0">
                        <a class="custom-accordion-title font-weight-bold d-block text-primary"
                            data-bs-toggle="collapse" href="#collapseWebsite"
                            aria-expanded="false" aria-controls="collapseWebsite">
                            Website
                        </a>
                    </h6>
                </div>
      
                <div id="collapseWebsite" class="collapse" aria-labelledby="headingWebsite" data-bs-parent="#accordionWebsite">
                  <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr class="text-gray-900 text-center">
                          <th>No</th>
                          <th>Permission <input {{(old('headerWebsite') == 'on')? 'checked':''}} class="float-right" type="checkbox" name="headerWebsite" id="txtHeaderWebsite"></th>
                          <th>View</th>
                          <th>Create</th>
                          <th>Show</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                    
                      <tbody>
                        <?php $i = 1; ?>
                        @foreach ($labels as $label)
                          @if($label->header != 'Website')
                            @continue
                          @endif
                          <tr class="text-center">
                            <td><?php echo $i; ?></td>
                            <td>
                            {!! $label->name !!}
                            <?php 
                                $old = "page$label->name";
                                $view = "view$label->name";
                                $create = "create$label->name";
                                $show = "show$label->name";
                                $edit = "edit$label->name";
                                $delete = "delete$label->name";
                            ?>
                            <input {{(old($old) == 'on')? 'checked':''}} type="checkbox" class="float-right" name="page{!! $label->name !!}">
                            </td>
                            <td><input {{(old($view) == 'on')? 'checked':''}} type="checkbox" name="view{!! $label->name !!}"></td>
                            <td><input {{(old($create) == 'on')? 'checked':''}} type="checkbox" name="create{!! $label->name !!}"></td>
                            <td><input {{(old($show) == 'on')? 'checked':''}} type="checkbox" name="show{!! $label->name !!}"></td>
                            <td><input {{(old($edit) == 'on')? 'checked':''}} type="checkbox" name="edit{!! $label->name !!}"></td>
                            <td><input {{(old($delete) == 'on')? 'checked':''}} type="checkbox" name="delete{!! $label->name !!}"></td>
                          </tr>

                        <?php $i++; ?>
                        @endforeach
                      </tbody>

                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- tab Card User's Role -->
            <div class="accordion" id="accordionRole1">
              <div class="card mb-0">
                <div class="card-header" id="headingRole">
                    <h6 class="m-0">
                        <a class="custom-accordion-title font-weight-bold d-block text-primary"
                            data-bs-toggle="collapse" href="#collapseRole"
                            aria-expanded="false" aria-controls="collapseRole">
                            Permission
                        </a>
                    </h6>
                </div>
      
                <div id="collapseRole" class="collapse" aria-labelledby="headingRole" data-bs-parent="#accordionRole1">
                  <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr class="text-gray-900 text-center">
                          <th>No</th>
                          <th>Permission <input {{(old('headerPermission') == 'on')? 'checked':''}} class="float-right" type="checkbox" name="headerPermission" id="txtHeaderPermission"></th>
                          <th>View</th>
                          <th>Create</th>
                          <th>Show</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                    
                      <tbody>
                        <?php $i = 1; ?>
                        @foreach ($labels as $label)
                          @if($label->header != 'Permission')
                            @continue
                          @endif
                          <tr class="text-center">
                            <td><?php echo $i; ?></td>
                            <td>
                            {!! $label->name !!}
                            <?php 
                                $old = "page$label->name";
                                $view = "view$label->name";
                                $create = "create$label->name";
                                $show = "show$label->name";
                                $edit = "edit$label->name";
                                $delete = "delete$label->name";
                            ?>
                            <input {{(old($old) == 'on')? 'checked':''}} type="checkbox" class="float-right" name="page{!! $label->name !!}">
                            </td>
                            <td><input {{(old($view) == 'on')? 'checked':''}} type="checkbox" name="view{!! $label->name !!}"></td>
                            <td><input {{(old($create) == 'on')? 'checked':''}} type="checkbox" name="create{!! $label->name !!}"></td>
                            <td><input {{(old($show) == 'on')? 'checked':''}} type="checkbox" name="show{!! $label->name !!}"></td>
                            <td><input {{(old($edit) == 'on')? 'checked':''}} type="checkbox" name="edit{!! $label->name !!}"></td>
                            <td><input {{(old($delete) == 'on')? 'checked':''}} type="checkbox" name="delete{!! $label->name !!}"></td>
                          </tr>

                        <?php $i++; ?>
                        @endforeach
                      </tbody>

                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <a href="{!! url('/role') !!}" class="btn btn-secondary">Back</a>
          {!! Form::submit('Create',array('class'=> 'btn btn-primary')) !!}
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection