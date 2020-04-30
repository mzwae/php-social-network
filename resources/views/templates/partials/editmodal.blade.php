<div class="modal" id="editModal-{{$id}}">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
        <h4 class="modal-title">Edit Your {{$title}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <form action="{{route('status.edit', ['statusId' => $id])}}" method="post">
            <div class="form-group">
            <label for="status-body">Edit {{$title}}</label>
              <textarea class="form-control" name="status-body" id="reply-body" cols="30" rows="10">{{$body}}</textarea>
            </div>

            <input type="submit" value="Save" class="btn btn-outline-primary">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
          </form>
        </div>


      </div>
    </div>
  </div>