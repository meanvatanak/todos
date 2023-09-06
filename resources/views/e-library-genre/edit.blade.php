<div class="modal-body">
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label for="">Genre Name</label>
        <input type="hidden" value="{{ $genre->id }}" name="id" id="id">
        <input type="text" value="{{ $genre->name }}"  name="name_genre" class="form-control" 
        id="name_genre" placeholder="Enter Author Name">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label class="switch">
          <input type="checkbox" name="status" id="status" {{( $genre->status == '1')? 'checked':''}}>
          <span class="slider round"></span>
        </label>
      </div>
    </div>
  </div>
</div>

