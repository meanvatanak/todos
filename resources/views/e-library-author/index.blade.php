@extends('admin.main')

@section('head')
<title>Author</title>
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
          <label for="">Name:</label>
          <div class="input-group">
            <input type="text" id="name" name="name" class="form-control" placeholder="Insert Name">
          </div>
        </li>
  
        <li class="mb-1">
          <div class="input-group">
            <button type="button" id="search" class="btn btn-success btn-block"> Search </button> 
          </div>
        </li>
      </ul>
    </div>
  </div>

  
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Author</h1>

    <div class="d-none d-inline-block">
      <button class="btn btn-primary shadow-sm btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
				aria-controls="offcanvasRight">Filter</button>
      @if(isset(session('permissions')[72]) && session('permissions')[72]['optCreate'] != 0)
        <button type="button" class="btn btn-primary btn-sm" id="btn_new">New</button>
      @endif
    </div>
  </div>

  <!-- DataTales Example -->
  <div class=" mb-4">
    <!-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
      </div> -->

    <div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm" id="dataTable2" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center bg-gradient-primary text-gray-100">
              <th style="width: 25px;">No</th>
              <th>Name</th>
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

  
  <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-light" id="standard-modalLabel">Create Author</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div>
        <form method="POST" action="{{ route('author.store') }}" id="create_store" autocomplete="off">
          @csrf
          <div id="form-content">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="save_btn" class="btn btn-primary">Save</button>
          </div>

        </form>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="update-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light" id="standard-modalLabel">Update Author</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div>
        <form method="POST" action="{{ route('author.update') }}" id="update_store" autocomplete="off">
          @csrf

          <div id="form-update">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            {{-- <button type="button" id="btn_save" class="btn btn-primary">Save</button> --}}
            <button type="submit" id="save_btn" class="btn btn-info">Update</button>
          </div>

        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="show-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="show-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light" id="standard-modalLabel">Show Author</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div>
        

        <div id="content-show-detail">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        </div>

        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="zeynep-overlay"></div>
</div>
@endsection

@section('javascript')
<script>
  $(document).ready(function() {

    var table = '';
    load_data();

    $('#search').on('click', function(){
      $('#dataTable2').DataTable().destroy();
      load_data();
    });

    function load_data()
    {
      var branch_id = $('#branch_id').val();
      var name = $('#name').val();

      table = $('#dataTable2').DataTable({
        processing:true,
        info:true,
        serverSide: true,
        ordering: true,
        ajax: {
          type: 'GET',
          url: "{{ route('author.getDataTable') }}",
          data: {
            'name': name,
            },
        },
        columns:[
          {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: "25px"},
          {data:'name', name: 'name'},
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

    }
    
    $('#update-modal').on('hidden.bs.modal', function () {
      $('#form-update').empty();
    });

    $('#btn_new').on('click', function(e){
      e.preventDefault();
      $('#standard-modal').modal('show');
      var widget_url = "<?php echo URL::to('author/create'); ?>";
      $.ajax({
        type: 'GET',
        url: widget_url,
        // data: { 'index': act },
        beforeSend: function() {
        },
        success: function(data) {
          $('#form-content').append(data);
        },
        error: function() {
        }
      });
    });

    $('#standard-modal').on('hidden.bs.modal', function () {
      $('#form-content').empty();
    });

    $("#create_store").on('submit',function(e) {

      e.preventDefault(); // avoid to execute the actual submit of the form.

      var form = $(this);
      var actionUrl = form.attr('action');
      var name_author = $('#name_author').val();
      
      if(name_author == '')
      {
        $('#name_author').addClass('border-danger');
        $('#name_author').focus();
        // $('#name').removeClass('fa-plus');
        return false;
      }
      $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
          if(data == 'Saved')
          {
            $('#standard-modal').modal('hide');
            $('#name_author').val('');
            $('#dataTable2').DataTable().destroy();
            load_data();
            $.NotificationApp.send("Store Saved!","","top-right","rgba(0,0,0,0.2)","success");
          }
        }
      });

    });

    $("#update_store").on( 'submit',function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var form = $(this);
      var actionUrl = form.attr('action');
      var name_author = $('#name_author').val();

      if(name_author == '')
      {
        $('#name_author').focus();
        return false;
      }
      $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
          if(data == 'Saved')
          {
            $('#update-modal').modal('hide');
            $('#name_author').val('');
            table.ajax.reload();
            $.NotificationApp.send("Store Update!","","top-right","rgba(0,0,0,0.2)","success");
          }
        }
      });

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

      $('.edit').on('click', function (e) {
        e.preventDefault();
        var eThis = $(this).parents('tr');
        var id = $(this).attr('data-id');
        var name = $.trim(eThis.find('td:eq(1)').text());
        // alert(job_type);
        // return false;
        $('#update-modal').modal('show');
        var widget_url = "<?php echo URL::to('author/edit'); ?>";
        $.ajax({
          type: 'GET',
          url: widget_url,
          data: { id: id , name: name},
          beforeSend: function() {
            // alert(widget_url);
          },
          success: function(data) {
            // alert(id)
            $('#form-update').append(data);
          },
          error: function() {
          }
        });
      });

    });



  });
</script>
@endsection