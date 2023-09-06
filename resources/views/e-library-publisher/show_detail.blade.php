<div class="row">
  <div class="col-lg-12">
    
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="">Name:</label> <span class="text-primary" style="font-family: 'Khmer OS Battambang', sans-serif;'">{{ $publisher_history->name }}</span>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          {{-- <label for="">Name:</label> <span class="text-primary" style="font-family: 'Khmer OS Battambang', sans-serif;'">{{ $publisher_history->name }}</span> --}}
        </div>
      </div>
    </div>

    <div class="form-group">
      @if ($publisher_history->status == 1)
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
          @if ($publisher_history->created_by)
            Created By {{ $publisher_history->created_by ? $publisher_history->created_by : '' }}
          @elseif($publisher_history->updated_by)
            Updated By {{ $publisher_history->updated_by ? $publisher_history->updated_by : '' }}
          @elseif($publisher_history->deleted_by)
            Deleted By{{ $publisher_history->deleted_by ? $publisher_history->deleted_by : '' }}
          @endif
        </span>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="form-group">
        <label for="">Action At</label> <label for="" style="font-family: Khmer OS Siemreap;">ការបញ្ចូលឫកែប្រែដោយ:</label> 
        <span class="text-primary" style="font-family: Khmer OS Siemreap;">
          @if ($publisher_history->created_at)
            Created At {{ $publisher_history->created_at ? date('d-M-Y H:s A', strtotime($publisher_history->created_at)) : ''}}
          @elseif($publisher_history->updated_at)
            Updated At {{ $publisher_history->updated_at ? date('d-M-Y H:s A', strtotime($publisher_history->updated_at)) : ''}}
          @elseif($publisher_history->deleted_at)
            Deleted At {{ $publisher_history->deleted_at ? date('d-M-Y H:s A', strtotime($publisher_history->deleted_at)) : ''}}
          @endif
        </span>
      </div>
    </div>
  </div>