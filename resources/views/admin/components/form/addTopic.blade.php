<div class="modal fade" id="addTopicModal" tabindex="-1" aria-labelledby="addTopicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content shadow-lg rounded border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addTopicModalLabel"><i class="fa fa-plus-circle"></i> Tambah Topik Permasalahan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.add.topic') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="topicName" class="font-weight-bold">Jenis Topik Permasalahan</label>
                        <input type="text" class="form-control shadow-sm" id="topicName" name="name" required placeholder="Masukkan jenis topik permasalahan">
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
