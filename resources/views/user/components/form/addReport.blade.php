<div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addReportModalLabel"><i class="fa fa-plus-circle"></i> Tambah Report</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{ route('user.add.report') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Name" class="font-weight-bold">Nama</label>
                        <input type="text" class="form-control shadow-sm" id="Name" value="{{ Auth::user()->name }}" disabled>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="form-group">
                        <label for="System" class="font-weight-bold">Sistem yang diadukan</label>
                        <select class="form-control shadow-sm" id="System" name="system_id" required>
                            <option value="">Pilih sistem</option>
                            @foreach ($system as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Topic" class="font-weight-bold">Topic / Jenis Error</label>
                        <select class="form-control shadow-sm" id="Topic" name="topic_id" required onchange="toggleCustomTopic(this)">
                            <option value="">Pilih Topic</option>
                            @foreach ($topic as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group" id="customTopicField" style="display: none;">
                        <label for="customTopic" class="font-weight-bold">Masukkan Jenis Error</label>
                        <input type="text" class="form-control shadow-sm" id="customTopic" name="custom_topic" placeholder="Tulis jenis error di sini">
                    </div>
                    <div class="form-group">
                        <label for="Description" class="font-weight-bold">Deskripsi</label>
                        <textarea class="form-control shadow-sm" id="sDescription" name="description" rows="3" required placeholder="Masukkan deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="customFile">Upload File Bukti</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="customFile" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
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