<!-- Modal -->
<div class="modal fade" id="confirmationReject-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationRejectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/account-request/approval/{{ $item->id }}" method="post">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="confirmationRejectLabel">Konfirmasi Reject</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="for" value="reject">
                    <p>Yakin ingin Reject akun ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-danger">Ya, Reject!</button>
                </div>
            </div>
        </form>
    </div>
</div>
