<div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Report reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="custom-select" id="report-reason">
                    {{-- TODO: find a way to list all the report reasons --}}
                    <option selected>Choose...</option>
                    <option value="1">Harassement</option>
                    <option value="2">Wrong category</option>
                    <option value="3">Explicit content</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Report</button>
            </div>
        </div>
    </div>
</div>