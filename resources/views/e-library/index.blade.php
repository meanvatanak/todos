@extends('admin.main')

@section('head')

@endsection

@section('content')

  <div class="container-fluid">
		<div style="width: 400px" class="zeynep right">
			<div class="card-head text-center mb-1 " style="background-color: darkblue;">
				<header class="p-2 border-bottom text-gray-900"><h5 class="text-light">Filter</h5></header>
			</div>
				<ul style="list-style-type: none;" class="p-2">

					<li class="mb-1">
						<label for="">Title:</label>
						<div class="input-group">
							<input type="text" class="form-control" name="title" id="title" placeholder="Title" autocomplete="off">
						</div>
					</li>

					<li class="mb-1">
						<label for="">Year:</label>
						<div class="input-group">
							<input type="text" class="form-control" name="year" id="year" placeholder="Year" autocomplete="off">
						</div>
					</li>

					<li class="mb-1">
						<label for="">Page:</label>
						<div class="input-group">
							<input type="text" class="form-control" name="page" id="page" placeholder="Page" autocomplete="off">
						</div>
					</li>

					<li class="mb-1">
						<label for="">Author:</label>
						<div class="input-group">
							<select name="author_id" id="author_id" class="form-control m-0 select2" data-toggle="select2">
								<option value="">-- Please Select Author --</option>
								@foreach ($authors as $author)
									<option value="{{ $author->id }}">{{ $author->name }}</option>
								@endforeach
							</select>
						</div>
					</li>

					<li class="mb-1">
						<label for="">Publisher:</label>
						<div class="input-group">
							<select name="publisher_id" id="publisher_id" class="form-control m-0 select2" data-toggle="select2">
								<option value="">-- Please Select Publisher --</option>
								@foreach ($publishers as $publisher)
									<option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
								@endforeach
							</select>
						</div>
					</li>

					<li class="mb-1">
						<label for="">Genre:</label>
						<div class="input-group">
							<select name="genre_id" id="genre_id" class="form-control m-0 select2" data-toggle="select2">
								<option value="">-- Please Select Genre --</option>
								@foreach ($genres as $genre)
									<option value="{{ $genre->id }}">{{ $genre->name }}</option>
								@endforeach
							</select>
						</div>
					</li>
		
					<li class="mb-1">
						<div class="input-group">
							<button type="button" id="search" class="btn btn-success btn-block"> Search </button> 
						</div>
					</li>

				</ul>
		</div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0">E-Library</h1>
			<div class="d-none d-inline-block mt-2">
        <button type="button" class="btn btn-sm btn-open btn-primary shadow-sm">Filter</button>
				@if(isset(session('permissions')[75]) && session('permissions')[75]['optCreate'] != 0)
					<a href="{!! url('/e-library/create') !!}" class="d-none d-inline-block btn btn-sm btn-primary shadow-sm">
						<i class="fas fa-create fa-sm text-white-50"></i> New
					</a>
				@endif
    	</div>
    </div>
		
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <!-- <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div> -->

    <div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover table-sm" id="dataTable2" width="100%"
					cellspacing="0">
					<thead>
						<tr class="text-center bg-gradient-primary text-gray-100">
							<th style="width: 25px;">No</th>
							<th>Cover</th>
							<th>Title</th>
							<th>Year</th>
							<th>Page</th>
							<th>Author</th>
							<th>Publisher</th>
							<th>Genre</th>
							<th>Sub Title</th>
							<th style="width: 50px;">Status</th>
							<th style="width: 60px;">Action</th>
						</tr>
					</thead>
					<tbody class="text-center">

					</tbody>
				</table>
			</div>
    </div>
  </div>
  <!-- end card -->
  </div>


	<div id="show-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light" id="standard-modalLabel">Show</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div>
				<div class="p-2" id="show-detail">
					
				</div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
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
		var title = $('#title').val();
		var year = $('#year').val();
		var page = $('#page').val();
		var author_id = $('#author_id').val();
		var publisher_id = $('#publisher_id').val();
		var genre_id = $('#genre_id').val();

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
            title: "E-Library List",
            text:'Excel',
						exportOptions: {
							// columns: [ 0, 2, 4, 5, 6 ]
							columns: ':visible'
						}
          },
          {
            extend: 'pdfHtml5',
            title: "E-Library List",
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
				url: "{{ route('e-library.getDatatable') }}",
				data: {
					'title': title,
					'year': year,
					'page': page,
					'author_id': author_id,
					'publisher_id': publisher_id,
					'genre_id': genre_id,
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

});
</script>
@endsection