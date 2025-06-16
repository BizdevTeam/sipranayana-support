<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}"><i class="fas fa-edit"></i> Edit Sistem</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.edit.sistem', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="systemName{{ $item->id }}" class="font-weight-bold">Nama Sistem</label>
                        <input type="text" class="form-control shadow-sm" id="systemName{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="systemDescription{{ $item->id }}" class="font-weight-bold">Deskripsi</label>
                        <textarea class="form-control shadow-sm" id="systemDescription{{ $item->id }}" name="description" rows="3" required>{{ $item->description }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>