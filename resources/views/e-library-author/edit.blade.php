<div class="modal-body">
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label for="">Author Name</label>
        <input type="hidden" value="{{ $author->id }}" name="id" id="id">
        <input type="text" value="{{ $author->name }}"  name="name_author" class="form-control" 
        id="name_author" placeholder="Enter Author Name">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label class="switch">
          <input type="checkbox" name="status" id="status" {{( $author->status == '1')? 'checked':''}}>
          <span class="slider round"></span>
        </label>
      </div>
    </div>
  </div>
</div>

