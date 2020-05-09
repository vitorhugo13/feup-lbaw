<div class="modal fade" id="move-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Move</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="categories-tab" class="modal-body">
                <div class="input-group">
                    <select class="custom-select">
                        <option selected>Add new category...</option>
                        @foreach (App\Models\Category::orderBy('title')->get() as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Add</button>
                    </div>
                </div>
                <div id="selected-categories">
                    @each('partials.categories.move_badge', $post_categories, 'category')
                </div>
                <input type="hidden" id="categories" name="categories" value="">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" data-post-id="{{ $id }}">Update</button>
            </div>
        </div>
    </div>
</div>