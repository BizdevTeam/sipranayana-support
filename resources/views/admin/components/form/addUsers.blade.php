<div class="modal fade" id="addUsersModal" tabindex="-1" aria-labelledby="addUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addUsersModalLabel"><i class="fa fa-plus-circle"></i> Tambah Users</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.add.users') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="UsersName" class="font-weight-bold">Nama Users</label>
                        <input type="text" class="form-control shadow-sm" id="UsersName" name="name" required
                            placeholder="Masukkan nama Users">
                    </div>
                    <div class="form-group">
                        <label for="Email" class="font-weight-bold">Email</label>
                        <input type="email" class="form-control shadow-sm" id="Email" name="email" required
                            placeholder="Masukkan email Users">
                    </div>
                    <div class="form-group">
                        <label for="Role" class="font-weight-bold">Role</label>
                        <select class="form-control shadow-sm" id="Role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="user">Users</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="AccountType" class="font-weight-bold">Jenis Akun</label>
                        <select class="form-control shadow-sm" id="AccountType" name="status" required>
                            <option value="">Pilih Jenis Akun</option>
                            @foreach ($accountType as $item)
                                <option value="{{ $item->name }}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Password" class="font-weight-bold">Password</label>
                        <input type="password" class="form-control shadow-sm" id="Password" name="password" required
                            placeholder="Masukkan password Users">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
