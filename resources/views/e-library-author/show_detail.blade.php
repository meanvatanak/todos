<div class="row">
  <div class="col-lg-12">
    
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="">Name:</label> <span class="text-primary" style="font-family: 'Khmer OS Battambang', sans-serif;'">{{ $author_history->name }}</span>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          {{-- <label for="">Name:</label> <span class="text-primary" style="font-family: 'Khmer OS Battambang', sans-serif;'">{{ $author_history->name }}</span> --}}
        </div>
      </div>
    </div>

    <div class="form-group">
      @if ($author_history->status == 1)
        <label for="">Status:</label> <span class="badge bg-success">Active</span>
      @else
        <label for="">Status:</label> <span class="badge bg-danger">In-Active</span>
      @endif
    </div>
    
  </div>
</div>

  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label for="">Action By</label> <label for="" style="font-family: Khmer OS Siemreap;">ការបញ្ចូលឫកែប្រែដោយ:</label> 
        <span class="text-primary" style="font-family: Khmer OS Siemreap;">
          @if ($author_history->created_by)
            Created By {{ $author_history->created_by ? $author_history->created_by : '' }}
          @elseif($author_history->updated_by)
            Updated By {{ $author_history->updated_by ? $author_history->updated_by : '' }}
          @elseif($author_history->deleted_by)
            Deleted By{{ $author_history->deleted_by ? $author_history->deleted_by : '' }}
          @endif
        </span>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="form-group">
        <label for="">Action At</label> <label for="" style="font-family: Khmer OS Siemreap;">ការបញ្ចូលឫកែប្រែដោយ:</label> 
        <span class="text-primary" style="font-family: Khmer OS Siemreap;">
          @if ($author_history->created_at)
            Created At {{ $author_history->created_at ? date('d-M-Y H:s A', strtotime($author_history->created_at)) : ''}}
          @elseif($author_history->updated_at)
            Updated At {{ $author_history->updated_at ? date('d-M-Y H:s A', strtotime($author_history->updated_at)) : ''}}
          @elseif($author_history->deleted_at)
            Deleted At {{ $author_history->deleted_at ? date('d-M-Y H:s A', strtotime($author_history->deleted_at)) : ''}}
          @endif
        </span>
      </div>
    </div>
  </div>