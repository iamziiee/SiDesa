<!-- Modal -->
<div class="modal fade" id="confirmationDelete-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/resident/{{ $item->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="confirmationDeleteLabel">Konfirmasi Hapus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin akan menghapus Data dengan Nomer Nik : {{ $item->nik }}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-danger">Ya, hapus!</button>
                </div>
            </div>
        </form>
    </div>
</div>
