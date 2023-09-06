<div class="modal-body">
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label for="">Publisher Name</label>
        <input type="hidden" value="{{ $publisher->id }}" name="id" id="id">
        <input type="text" value="{{ $publisher->name }}"  name="name_publisher" class="form-control" 
        id="name_publisher" placeholder="Enter Author Name">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label class="switch">
          <input type="checkbox" name="status" id="status" {{( $publisher->status == '1')? 'checked':''}}>
          <span class="slider round"></span>
        </label>
      </div>
    </div>
  </div>
</div>

