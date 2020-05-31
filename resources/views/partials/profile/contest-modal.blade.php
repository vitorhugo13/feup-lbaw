
<div class="modal fade" id="contest-modal" tabindex="-1" role="dialog" aria-labelledby="report-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="report-modal-title">Contest reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="blocked-reason">

                    @php
                        
                    @endphp

                    <!--TODO: ir buscar razões de o user ter sido bloqueado-->
                    <span class="block-title"> Block reason:</span> You were blocked because you did not follow the LAMA rules
                </div>
                <div class="contest-reason">
                    <textarea rows="5" cols="49" placeholder="Here you must present the reason why you think you shouldn't have been blocked." class="mt-3 form-control justification" name="reason_contest"></textarea> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submitContest">Send</button>
            </div>
        </div>
    </div>
</div>