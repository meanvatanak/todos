@extends('admin.main')

@section('head')

@endsection

@section('content')

<div class="container-fluid">
  
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Show Auhtor</h1>
  </div>
 
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12">
          
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Name:</label> <span class="text-primary" style="font-family: 'Khmer OS Battambang', sans-serif;'">{{ $author->name }}</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            @if ($author->status == 1)
              <label for="">Status:</label> <span class="badge bg-success">Active</span>
            @else
              <label for="">Status:</label> <span class="badge bg-danger">In-Active</span>
            @endif
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal-footer">
    <a href="{!! url('/author') !!}" class="btn btn-secondary">Back</a>
  </div>

  <div class="modal-footer">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover table-sm" id="dataTable2" width="100%"
        cellspacing="0">
        <thead>
          <tr class="text-center bg-gradient-primary text-gray-100">
            <th style="width: 25px;">No</th>
            <th>Name</th>
            <th style="width: 50px;">Status</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th>Date and Time</th>
            <th style="width: 60px;">Action</th>
          </tr>
        </thead>
        <tbody class="text-center">

        </tbody>
      </table>
    </div>
  </div>
</div>

<div id="show-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="update-content">
      <div class="modal-header bg-info">
        <h4 class="h4 mb-0">Show Author History</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="p-2" id="show-detail">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<input type="hidden" id="author_id" value="{{ $author->id }}">

@endsection

@section('javascript')
<script>
  $(document).ready(function() {
  
    var table = '';
  
    load_data();
    
    function load_data()
    {
      var author_id = $('#author_id').val();

      table = $('#dataTable2').DataTable({
        processing:true,
        info:true,
        serverSide: true,
        ordering: true,
        dom: 'Blfrtip',
          lengthMenu: [[10, 50, 100, 500, -1], [10, 50, 100, 500, "All"]],
          dom: 'Bfrtip',
          buttons: [
            {
              extend: 'excelHtml5',
              title: "History of Author",
              text:'Excel',
              exportOptions: {
                // columns: [ 0, 2, 4, 5, 6 ]
                columns: ':visible'
              }
            },
            {
              extend: 'pdfHtml5',
              title: "History of Author",
              text: 'PDF',
              exportOptions: {
                // columns: [ 0, 2, 4, 5, 6 ]
                columns: ':visible'
              }
            },
            {
              extend: 'pageLength',
            },
            {
              extend: 'colvis',
            },
          ],
        ajax: {
          type: 'GET',
          url: "{{ route('authors-history.getDatatable') }}",
          data: {
            'author_id': author_id,
            },
        },
        columns:[
          {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
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
          {data:'created_bys', name: 'created_bys'},
          {data:'updated_bys', name: 'updated_bys'},
          {data:'date_time', name: 'date_time'},
          { 
            data: 'action' ,
            name: 'action' ,
            "searchable": false,
            "orderable": false,
          },
        ],
      });
  
    }
  
    table.on('draw.dt', function () {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        $('.show_detail').on('click', function(e){
          e.preventDefault();
          $('#show-modal').modal('show');
          const url = $(this).attr('href');
          $.ajax({
            type: 'GET',
            url: url,
            // data: { 'id': id },
            beforeSend: function() {
            },
            success: function(data) {
              $('#show-detail').append(data);
            },
            error: function() {
            }
          });
        });

        //modal create dismiss and remove item in div
        $('#show-modal').on('hidden.bs.modal', function () {
          $('#show-detail').empty();
        });
  
    });
  
  });
  </script>
@endsection