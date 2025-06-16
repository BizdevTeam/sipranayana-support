<div class="modal fade" id="addAccountTypeModal" tabindex="-1" aria-labelledby="addAccountTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content shadow-md rounded border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addAccountTypeModalLabel"><i class="fa fa-plus-circle"></i> Tambah Jenis Akun</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.add.accountType') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="accounttypeName" class="font-weight-bold">NamaJenis Akun</label>
                        <input type="text" class="form-control shadow-sm" id="accounttypeName" name="name" required placeholder="Masukkan namajenis akun">
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
