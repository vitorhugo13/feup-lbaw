<div class="modal fade" id="move-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Move</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <select class="custom-select">
                        <option selected>Add new category...</option>
                        <option value="1">College</option>
                        <option value="2">World</option>
                        <option value="3">Economics</option>
                        <option value="3">Cinema</option>
                        <option value="3">Music</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Add</button>
                    </div>
                </div>
                <div class="selected-categories">
                    <?php draw_category_move_badge('Politics'); ?>
                    <?php draw_category_move_badge('Gaming'); ?>
                    <?php draw_category_move_badge('Ethics'); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>