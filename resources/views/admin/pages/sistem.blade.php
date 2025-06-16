@extends('admin.layouts.App')
@section('title')
    Management Sistem
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="m-0 text-bold">Management Sistem</h3>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSystemModal">
                                <i class="fa fa-plus-circle"></i> Tambah Sistem
                            </button>
                        </div>
                        @include('admin.components.form.addSystem')
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid px-2">
                <div class="card mt-2">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabel Data Sistem
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sistem</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($system as $item)
                                    <tr>
                                        <td style="width: 50px">{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td style="width: 150px;">
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionMenu{{ $item->id }}" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cogs"></i> Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actionMenu{{ $item->id }}">
                                                    <!-- Tombol Edit -->
                                                    <button class="dropdown-item text-warning" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <!-- Tombol Delete dengan konfirmasi -->
                                                    <form action="{{ route('admin.delete.sistem', $item->id) }}" method="POST" class="d-inline">
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
                                    @include('admin.components.form.updateSystem')
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
