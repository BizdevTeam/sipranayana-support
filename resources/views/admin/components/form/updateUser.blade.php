<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}"><i class="fas fa-edit"></i> Edit User</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.edit.users', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="UsersName" class="font-weight-bold">Nama Users</label>
                        <input type="text" class="form-control shadow-sm" id="UsersName" name="name" value="{{ $item->name }}"
                            placeholder="Masukkan nama Users">
                    </div>
                    <div class="form-group">
                        <label for="Email" class="font-weight-bold">Email</label>
                        <input type="email" class="form-control shadow-sm" id="Email" name="email" value="{{ $item->email }}"
                            placeholder="Masukkan email Users">
                    </div>
                    <div class="form-group">
                        <label for="Role" class="font-weight-bold">Role</label>
                        <select class="form-control shadow-sm" id="Role" name="role" value="">
                            <option value="">Pilih Role</option>
                            <option value="user">Users</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="AccountType" class="font-weight-bold">Jenis Akun</label>
                        <select class="form-control shadow-sm" id="AccountType" name="status" >
                            <option value="">Pilih Jenis Akun</option>
                            @foreach ($accountType as $item)
                                <option value="{{ $item->name }}">{{$item->name}}</option>
                            @endforeach
                        </select>
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