<div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="edit-category-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST">
        {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title" id="edit-category-title">Edit category</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="category-input modal-body">
                <input type="text" name="name" id="edit-category-name" placeholder="New Category Name"/>
                @if ($errors->has('name'))
                <span class="error">
                    {{ $errors->first('name') }}
                </span>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" data-dismiss="modal">Update</button>
            </div>
        </form>
    </div>
</div>