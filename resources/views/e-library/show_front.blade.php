@extends('frontend.main')

@section('style')
  <!-- Custom styles for this page -->
  {{-- <link rel="stylesheet"  href="{{ URL::asset('/css/sb-admin-2.min.css') }}"> --}}
  <link  href="{{ URL::asset('/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
  <div class="row text-center my-3">
    <div class="col-lg-12">
      <h2 style="color: darkblue;">CAM-ASEAN E-Library</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
      <label for="" style="color: darkblue;">Title:</label>
      <div class="input-group">
        <input type="text" class="form-control" name="title" id="title" placeholder="Title" autocomplete="off">
      </div>
    </div>
    <div class="col-lg-3">
      <label for="" style="color: darkblue;">Author:</label>
      <div class="input-group">
        <select name="author_id" id="author_id" class="form-control m-0 select2" data-toggle="select2">
          <option value="">-- Please Select Author --</option>
          @foreach ($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-lg-3">
      <label for="" style="color: darkblue;">Publisher:</label>
      <div class="input-group">
        <select name="publisher_id" id="publisher_id" class="form-control m-0 select2" data-toggle="select2">
          <option value="">-- Please Select Publisher --</option>
          @foreach ($publishers as $publisher)
            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-lg-3">
      <label for="" style="color: darkblue;">Genre:</label>
      <div class="input-group">
        <select name="genre_id" id="genre_id" class="form-control m-0 select2" data-toggle="select2">
          <option value="">-- Please Select Genre --</option>
          @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="row my-3">
    <div class="col-lg-3"></div>
    <div class="col-lg-3"></div>
    <div class="col-lg-3"></div>
    <div class="col-lg-3">
      <div class="input-group">
        <button type="button" id="search" class="btn btn-success btn-block"> Search </button> 
      </div>
    </div>
  </div>

  <div class="card shadow my-4">
    <div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover table-sm" id="dataTable2" width="100%"
					cellspacing="0">
					<thead>
						<tr class="text-center text-dark">
							<th style="width: 25px;">No</th>
							<th>Cover</th>
							<th>Title</th>
							<th>Year</th>
							<th>Page</th>
							<th>Author</th>
							<th>Publisher</th>
							<th>Genre</th>
							<th>Sub Title</th>
						</tr>
					</thead>
					<tbody class="text-center text-dark">

					</tbody>
				</table>
			</div>
    </div>
  </div>
</div>

@endsection

@section('script_front')
<!-- Core plugin JavaScript-->
<script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ URL::asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ URL::asset('js/demo/datatables-demo.js') }}"></script>

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
      ajax: {
        type: 'GET',
        url: "{{ route('e-libraries.front_getDataTable') }}",
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
        {data:'title_click', name: 'title_click'},
        {data:'year', name: 'year'},
        {data:'page', name: 'page'},
        {data:'author', name: 'author'},
        {data:'publisher', name: 'publisher', visible: true},
        {data:'genre', name: 'genre', visible: true},
        {data:'sub_title', name: 'sub_title', visible: false},
      ],
    });

  }

  table.on('draw.dt', function () {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
  });
});
</script>
@endsection