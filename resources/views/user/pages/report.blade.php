@extends('user.layouts.App')
@section('title')
    Halaman Report
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                        <h1 class="mt-2 text-bold">Halaman Report</h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addReportModal">
                            <i class="fa fa-plus-circle"></i> Tambah Report
                        </button>
                        @include('user.components.form.addReport')
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
                        Tabel Data Report
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 50px">No</th>
                                    <th>Nama</th>
                                    <th>Sistem</th>
                                    <th>Topik</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($reports as $item)
                                    <tr>
                                        <td style="width: 50px">{{ $no++ }}</td>
                                        <td>{{ optional($item->user)->name ?? 'User Tidak Diketahui' }}</td>
                                        <td>{{ optional($item->system)->name ?? 'Sistem Tidak Diketahui' }}</td>
                                        <td>{{ optional($item->topic)->name ?? ($item->custom_topic ?? 'Topik Tidak Diketahui') }}
                                        </td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @if ($item->status == 'Menunggu Konfirmasi')
                                                <span class="badge badge-secondary">Menunggu Konfirmasi</span>
                                            @elseif ($item->status == 'Diproses')
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif ($item->status == 'Selesai')
                                                <span class="badge badge-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->file_proof)
                                                <!-- Tombol Lihat -->
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#viewFileModal{{ $item->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            @else
                                                <span class="text-muted">Tidak ada bukti</span>
                                            @endif
                                        
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editFileModal{{ $item->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('user.delete.report', $item->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @foreach ($reports as $item)
                <div class="modal fade" id="viewFileModal{{ $item->id }}" tabindex="-1"
                    aria-labelledby="viewFileModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="viewFileModalLabel{{ $item->id }}">Bukti Laporan</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                @if ($item->file_proof)
                                    <img src="{{ asset('images/report_files/' . $item->file_proof) }}" class="img-fluid rounded shadow"
                                        alt="Bukti Laporan">
                                @else
                                    <p class="text-muted">Tidak ada bukti tersedia</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @include('user.components.form.editReport')
        </section>
        <!-- /.content -->
    </div>
@endsection
