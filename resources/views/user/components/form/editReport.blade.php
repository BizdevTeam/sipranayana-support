@foreach ($reports as $report)
<div class="modal fade" id="editFileModal{{ $report->id }}" tabindex="-1" aria-labelledby="editFileModalLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded border-0">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editFileModalLabel{{ $report->id }}"><i class="fa fa-edit"></i> Edit File</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.update.report', $report->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="font-weight-bold">Nama</label>
                        <input type="text" class="form-control shadow-sm" value="{{ Auth::user()->name }}" disabled>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                
                    <div class="form-group">
                        <label class="font-weight-bold">Sistem yang diadukan</label>
                        <select class="form-control shadow-sm" id="System{{ $report->id }}" name="system_id" required>
                            <option value="">Pilih sistem</option>
                            @foreach ($system as $sys)
                                <option value="{{ $sys->id }}" {{ old('system_id', $report->system_id) == $sys->id ? 'selected' : '' }}>
                                    {{ $sys->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label class="font-weight-bold">Topic / Jenis Error</label>
                        <select class="form-control shadow-sm" id="Topic{{ $report->id }}" name="topic_id" onchange="toggleCustomTopic(this, {{ $report->id }})">
                            <option value="">Pilih Topic</option>
                            @foreach ($topic as $top)
                                <option value="{{ $top->id }}" {{ old('topic_id', $report->topic_id) == $top->id ? 'selected' : '' }}>
                                    {{ $top->name }}
                                </option>
                            @endforeach
                            <option value="other" {{ old('topic_id', $report->topic_id) == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                
                    <div class="form-group" id="customTopicField{{ $report->id }}" style="{{ old('custom_topic', $report->custom_topic) ? '' : 'display: none;' }}">
                        <label class="font-weight-bold">Masukkan Jenis Error</label>
                        <input type="text" class="form-control shadow-sm" name="custom_topic" placeholder="Tulis jenis error di sini" value="{{ old('custom_topic', $report->custom_topic) }}">
                    </div>
                
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi</label>
                        <textarea class="form-control shadow-sm" name="description" rows="3" placeholder="Masukkan deskripsi">{{ old('description', $report->description) }}</textarea>
                    </div>
                
                    <div class="form-group">
                        <label>Upload File Bukti</label>
                        
                        @if ($report->file_proof)
                            <div class="mb-2">
                                <img src="{{ asset('storage/report_files/' . $report->file_proof) }}" alt="Bukti laporan" class="img-fluid rounded shadow" style="max-height: 200px;">
                                <p class="mt-1"><small class="text-muted">File saat ini: {{ $report->file }}</small></p>
                            </div>
                        @endif
                    
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="customFile{{ $report->id }}" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="customFile{{ $report->id }}">Pilih file</label>
                        </div>
                    </div>
                    
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
