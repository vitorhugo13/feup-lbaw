<div class="modal fade" id="block-modal" tabindex="-1" role="dialog" aria-labelledby="block-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="block-modal-title">Confirm Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2 mt-2">
                <p> Choose the amount of time the user will be blocked: </p>
                <label>Block Time (in hours) <input id="block-time-input" type="number" min="24" max="8760" placeholder="24"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirm-block">Block</button>
            </div>
        </div>
    </div>
</div>