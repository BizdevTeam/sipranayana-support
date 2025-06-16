<div class="modal fade" id="addSystemModal" tabindex="-1" aria-labelledby="addSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addSystemModalLabel"><i class="fa fa-plus-circle"></i> Tambah Sistem</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.add.sistem') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="systemName" class="font-weight-bold">Nama Sistem</label>
                        <input type="text" class="form-control shadow-sm" id="systemName" name="name" required placeholder="Masukkan nama sistem">
                    </div>

                    <div class="form-group">
                        <label for="systemDescription" class="font-weight-bold">Deskripsi</label>
                        <textarea class="form-control shadow-sm" id="systemDescription" name="description" rows="3" required placeholder="Masukkan deskripsi sistem"></textarea>
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
