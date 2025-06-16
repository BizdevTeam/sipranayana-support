@extends('admin.layouts.App')
@section('title')
    Management Reports
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-bold">Management Reports</h3>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid px-3">       
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabel Data Reports
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-hover table-bordered table-striped align-middle" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px">No</th>
                                    <th>Nama</th>
                                    <th>Sistem yang diadukan</th>
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
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#viewFileModal{{ $item->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            @else
                                                <span class="text-muted">Tidak ada bukti</span>
                                            @endif
                                            @if($item->status == 'Menunggu Konfirmasi')
                                            <form action="{{ route('admin.proses.reports', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-spinner fa-spin"></i> Proses
                                                </button>
                                            </form>
                                        @elseif($item->status == 'Diproses')
                                            <form action="{{ route('admin.selesai.reports', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-check"></i> Selesai
                                                </button>
                                            </form>
                                        @endif                                                                                                                
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
        </section>
        <!-- /.content -->
    </div>
@endsection
