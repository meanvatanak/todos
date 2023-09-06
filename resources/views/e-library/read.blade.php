@extends('frontend.main')

@section('style')
  <!-- Custom styles for this page -->
  {{-- <link rel="stylesheet"  href="{{ URL::asset('/css/sb-admin-2.min.css') }}"> --}}
  <link  href="{{ URL::asset('/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  {{-- header("Content-type: application/pdf"); --}}
  {{-- header("Content-Disposition: inline; filename=filename.pdf"); --}}
@endsection

@section('content')

<div class="container-fluid">
  {{-- {{ $elibrary->book_file }} --}}
  {{-- <iframe src="{{ asset('/storage/book_file/'.$elibrary->book_file) }}" width="100%" height="500" alt="pdf" /> --}}
  <embed src="{{ asset('/storage/book_file/'.$elibrary->book_file) }}" width="100%" height="1000" alt="pdf" />
  {{-- <embed src="{{ asset('/storage/book_out/0b857k_1664264755.pdf') }}" width="600" height="500" alt="pdf" /> --}}
</div>

@endsection

@section('script_front')
<script>
$(document).ready(function() {
  
});
</script>
@endsection