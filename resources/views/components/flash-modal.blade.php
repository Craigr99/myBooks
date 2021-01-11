<div>
    <div class="clearfix"></div>
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this book?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.books.destroy', $id) }}">
                        <input type="hidden" value="DELETE" name="_method">
                        @csrf
                        <button class="btn my-btn my-btn my-btn-danger rounded" type="submit">Delete</button>
                    </form>
                    <button type="button" class="btn my-btn my-btn-outline" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
