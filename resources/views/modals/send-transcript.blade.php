<!-- Modal -->
<div class="modal fade" id="send-transcript" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="d-flex p-3 justify-content-between">
                <h5 id="modal_title" class="modal-title">Send Transcript</h5>
                <div type="button" class="ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>
            </div>
            <form action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="eg. admissions@havard.co.uk" aria-describedby="email" required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2 px-4" data-dismiss="modal" style="font-size: 12px">Close</button>
                            <button type="submit" class="btn btn-second px-4" style="font-size: 12px">Send <i class="bx bx-send"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
