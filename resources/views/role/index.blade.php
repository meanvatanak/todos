@extends('admin.main')

@section('head')
<title>Role</title>
@endsection

@section('content')

<div class="container-fluid">

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="card-head text-center mb-1 " style="background-color: darkblue;">
      <header class="p-2 border-bottom text-gray-900"><h5 class="text-light">Filter</h5></header>
    </div>
    <div class="offcanvas-body">
      <ul style="list-style-type: none;" class="p-0">
        <li class="mb-1">
          <label for="">Role:</label>
          <div class="input-group">
            <input type="text" id="name" name="name" class="form-control" placeholder="Insert Role">
          </div>
        </li>
  
        <li class="mb-1">
          <div class="input-group">
            {{-- <button type="submit" class="btn btn-success btn-block"> Search </button>   --}}
            <button type="button" id="search" class="btn btn-success btn-block"> Search </button> 
          </div>
        </li>
      </ul>
    </div>
  </div>

  
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Roles</h1>

    <div class="d-none d-sm-inline-block mt-2">
      <button class="btn btn-primary shadow-sm btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
      aria-controls="offcanvasRight">Filter</button>
      {{-- @if(navbarCheck()[8]->optCreate != 0) --}}
      <a href="{!! url('/role/create') !!}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-create fa-sm text-white-50"></i> New
      </a>
      {{-- @endif --}}
    </div>
  </div>

  <!-- DataTales Example -->
  <div class=" mb-4">
    <!-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
      </div> -->

    <div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm"  id="dataTable2" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center bg-gradient-primary text-white">
              <th style="width: 25px;">No</th>
              <th>Role</th>
              <th>Remark</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <!-- list all branch -->
          <tbody class="text-center">
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="zeynep-overlay"></div>
</div>
@endsection

@section('javascript')
<script>
  $(document).ready(function() {

    load_data();

    $('#search').on('click', function(){
      $('#dataTable2').DataTable().destroy();
      load_data();
    });

    function load_data()
    {
      var name = $('#name').val();

      var table = $('#dataTable2').DataTable({
        processing:true,
        info:true,
        serverSide: true,
        ordering: true,
        ajax: {
          type: 'GET',
          url: "{{ route('role.getDatatable') }}",
          data: {
            'name': name,
            },
        },
        columns:[
          {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
          {data:'role_name', name: 'role_name'},
          {data:'remark', name: 'remark'},
          {
            data: "status", 
            name: 'status',
            "searchable": false,
            "orderable": true,
            "render": function (data, type, row) 
            {
              if (data == '1')
              { return '<span class="badge bg-success">Active</span>'; }
              else
              { return '<span class="badge bg-danger">In-Active</span>'; }
            }
          },
          { 
            data: 'action' ,
            name: 'action' ,
            "searchable": false,
            "orderable": false,
          },
        ],

      });

      table.on('draw.dt', function () {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        $('.delete-confirm').on('click', function(e) {
          e.preventDefault();
          const url = $(this).attr('href');
          Swal.fire({
              title: 'Are you sure to delete?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete!'
            })
            .then(function(e) {
              if (e.value == true) {
                window.location.href = url;
              } else {
                e.dismiss;
              }
            }, function (dismiss) {
                return false;
            });
        });
      });

    }

  });
</script>
@endsection