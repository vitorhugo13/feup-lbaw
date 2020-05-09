<div class="modal fade" id="new-category-modal" tabindex="-1" role="dialog" aria-labelledby="new-category-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST">
        {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title" id="new-category-title">New category</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="category-input modal-body">
                <input type="text" name="name" id="new-category-name" placeholder="New Category Name"/>
                <span class="error">
                </span>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>