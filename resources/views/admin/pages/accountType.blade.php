@extends('admin.layouts.App')
@section('title')
    Jenis Akun
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="m-0 text-bold">Management Jenis Akun</h3>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountTypeModal">
                                <i class="fa fa-plus-circle"></i> Tambah Jenis Akun
                            </button>
                            @include('admin.components.form.addAccountType')
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid px-4">
                <div class="card mt-2">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabel Data Jenis Akun
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jenis Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($AccountType as $item)
                                    <tr>
                                        <td style="width: 50px">{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td style="width: 150px;">
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                    id="actionMenu{{ $item->id }}" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cogs"></i> Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actionMenu{{ $item->id }}">
                                                    <!-- Tombol Edit -->
                                                    <button class="dropdown-item text-warning" data-toggle="modal"
                                                        data-target="#editModal{{ $item->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <!-- Tombol Delete dengan konfirmasi -->
                                                    <form action="{{ route('admin.delete.accountType', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger btn-delete">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    @include('admin.components.form.updateAccountType')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
