                <!-- Delete Reply Button Modal HTML -->
                <div id="deleteReplyModal-{{$id}}" class="modal fade delete-modal">
                    <div class="modal-dialog modal-confirm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                          </div>
                          <h4 class="modal-title">Are you sure?</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                          <p>Do you really want to delete this? This process cannot be undone.</p>
                        </div>
                        <div class="modal-footer">
                          <form action="{{route('status.delete', ['statusId' => $id])}}" method="POST">
                            <input value="Delete" type="submit" class="btn btn-danger">
                            @method('DELETE')
                            @CSRF
                          </form>
                          <a type="button" class="btn btn-info" data-dismiss="modal">Cancel</a>
                        </div>
                      </div>
                    </div>
                  </div>