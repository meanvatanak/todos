@extends('admin.main')

@section('head')

@endsection

@section('content')

<div class="container-fluid">
  
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Show Book</h1>
  </div>
 
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
              </div>
            </div>
          </div>	
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body p-2">
                <h5 class="card-title mb-3">Book's File</h5>
                @if($elibrary->book_file != '')
                <div class="card my-1 shadow-none border">
                  <div class="p-1">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <div class="avatar-sm">
                          <span class="avatar-title rounded">
                            @if($elibrary->book_file != '')
                            <i class="fas fa-file-pdf"></i>
                            @else
                            <i class="far fa-file"></i>
                            @endif
                          </span>
                        </div>
                      </div>
                      
                      <div class="col p-0">
                        <a href="{!! url('/storage/book_file/' . $elibrary->book_file) !!}" style="font-size: 12px" class="text-muted font-weight-bold">{{$elibrary->title}}'s CV</a>
                        {{-- <p class="mb-0">2.3 MB</p> --}}
                      </div>
                      <div class="col-auto p-0">
                        <!-- Button -->
                        <a href="{!! url('/storage/book_file/' . $elibrary->book_file) !!}" class="btn btn-link btn-lg text-muted">
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
                              @if($elibrary->book_file != '')
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
    <div class="col-lg-9">
      <div class="row">
        <div class="col-lg-12">
          
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Title:</label> <span class="text-primary">{{ $elibrary->title }}</span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Year:</label> <span class="text-primary" >{{ $elibrary->year }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Page:</label> <span class="text-primary" >{{ $elibrary->page }}</span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Author:</label> <span class="text-primary" >{{ $elibrary->author->name }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Publisher:</label> <span class="text-primary" >{{ $elibrary->publisher->name }}</span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Genre:</label> <span class="text-primary" >{{ $elibrary->genre->name }}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="">Sub Title:</label>
                <p class="text-gray-900" style="white-space: pre-wrap; font-size: 16px;">{{ $elibrary->sub_title }}</p>
              </div>
            </div>
          </div>

          <div class="form-group">
            @if ($elibrary->status == 1)
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
    <a href="{!! url('/e-library') !!}" class="btn btn-secondary">Back</a>
  </div>

  <div class="modal-footer">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover table-sm" id="dataTable2" width="100%"
        cellspacing="0">
        <thead>
          <tr class="text-center bg-gradient-primary text-gray-100">
            <th style="width: 25px;">No</th>
            <th>Book Cover</th>
            <th>Title</th>
            <th>Year</th>
            <th>Page</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Genre</th>
            <th>Sub Title</th>
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
        <h4 class="h4 mb-0">Show E-Library History</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="p-2" id="show-detail">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<input type="hidden" id="elibrary_id" value="{{ $elibrary->id }}">

@endsection

@section('javascript')
<script>
  $(document).ready(function() {
  
    var table = '';
  
    load_data();
    
    function load_data()
    {
      var elibrary_id = $('#elibrary_id').val();

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
              title: "History of E-Book List",
              text:'Excel',
              exportOptions: {
                // columns: [ 0, 2, 4, 5, 6 ]
                columns: ':visible'
              }
            },
            {
              extend: 'pdfHtml5',
              title: "History of E-Book List",
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
          url: "{{ route('e-library-history.getDatatable') }}",
          data: {
            'elibrary_id': elibrary_id,
            },
        },
        columns:[
          {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
          {
            data: "book_cover", 
            name: 'book_cover',
            "searchable": false,
            "orderable":false,
            "render": function (data, type, row) 
            {
              if (data != null)
              { return '<a href="img/e_library/'+data+'" target="_blank">'+
                          '<img class="img-profile rounded-circle" style="width: 25px; height: 25px;"'+
                            'src="/img/e_library/'+data+'">'+
                        '</a>'; }
              else
              { return '<a href="img/icon/book-cover.jpg" target="_blank">'+
                          '<img class="img-profile rounded-circle" style="width: 25px; height: 25px;"'+
                            'src="img/icon/book-cover.jpg">'+
                        '</a>'; }
            }
          },
          {data:'title', name: 'title'},
          {data:'year', name: 'year'},
          {data:'page', name: 'page'},
          {data:'author', name: 'author'},
          {data:'publisher', name: 'publisher', visible: false},
          {data:'genre', name: 'genre', visible: false},
          {data:'sub_title', name: 'sub_title', visible: false},
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