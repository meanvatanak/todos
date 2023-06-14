@extends('admin.main')

@section('head')
<title>User</title>
@endsection

@section('content')

<div class="container-fluid">
 
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">User History</h1>
    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
    <div class="d-none d-sm-inline-block mt-2">
      {{-- <button class="btn btn-primary shadow-sm btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
      aria-controls="offcanvasRight">Filter</button> --}}
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
              <th>Photo</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Created By</th>
              <th>Created Date</th>
              <th>Updated By</th>
              <th>Updated Date</th>
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

<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">User History</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div id="modal-content">

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
      var user_id = $('#user_id').val();

      var table = $('#dataTable2').DataTable({
        processing:true,
        info:true,
        serverSide: true,
        ordering: true,
        ajax: {
          type: 'GET',
          url: "{{ route('user_history.getDatatable') }}",
          data: {
            'user_id': user_id,
            },
        },
        columns:[
          {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
          {
            data: 'image', 
            name: 'image',
            "searchable": false,
            "orderable":false,
            "render": function (data, type, row) 
            {
              if (data != null)
              { return '<a href="/img/user/'+data+'" target="_blank">'+
                          '<img class="img-profile rounded-circle" style="width: 25px; height: 25px;"'+
                            'src="/img/user/'+data+'">'+
                        '</a>'; 
              }
              else
              { 
                return '<a href="/img/undraw_profile.svg" target="_blank">'+
                          '<img class="img-profile rounded-circle" style="width: 25px; height: 25px;"'+
                            'src="/img/undraw_profile.svg">'+
                        '</a>'; 
              }
            }
          },
          {data:'name', name: 'name'},
          {data:'phone', name: 'phone'},
          {data:'created_name', name: 'created_name'},
          {
            data: "created_at", name: "created_at", 
            "render": function (value) 
            {
              if (value === null) return "-";
              return moment(value).format('DD-MMM-YYYY');
            }
          },
          {data:'updated_name', name: 'updated_name'},
          {
            data: "updated_at", name: "updated_at", 
            "render": function (value) 
            {
              if (value === null) return "-";
              return moment(value).format('DD-MMM-YYYY');
            }
          },
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

        $('.btn-show').on('click', function(e){
          e.preventDefault();
          $('#bs-example-modal-lg').modal('show');
          const url = $(this).attr('href');
          $.ajax({
            type: 'GET',
            url: url,
            // data: { 'id': id },
            beforeSend: function() {
            },
            success: function(data) {
              $('#modal-content').append(data);
            },
            error: function() {
            }
          });
        });

        //modal create dismiss and remove item in div
        $('#bs-example-modal-lg').on('hidden.bs.modal', function () {
          $('#modal-content').empty();
        });

      });

    }

  });
</script>
@endsection