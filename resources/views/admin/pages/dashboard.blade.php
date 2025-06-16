@extends('admin.layouts.Dashboard')
@section('title')
    Dashboard || Admin
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-4">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalReports }}</h3>

                                <p>Total Report</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-folder-open"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $menunggu }}</h3>

                                <p>Menunggu Konfirmasi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $diproses }}</h3>

                                <p>Diproses</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $selesai }}</h3>

                                <p>Selesai</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->

                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row mr-0">
                    <div class="col-md-8">
                        <!-- Timeline -->
                        <div class="timeline">
                            @php
                                $currentDate = null;
                            @endphp

                            @foreach ($reportLogs as $log)
                                @php
                                    $logDate = \Carbon\Carbon::parse($log->created_at)->format('d M Y');
                                    $isCurrentUser = $log->user && $log->user->role === 'user';
                                    $isAdmin = $log->user && $log->user->role === 'admin';
                                    $bubbleColor = $isAdmin ? '#fff3cd' : ($isCurrentUser ? '#d4edda' : '#e3e3e3');
                                    $textColor = $isAdmin ? '#856404' : ($isCurrentUser ? '#155724' : '#333');
                                    $iconColor = $isAdmin
                                        ? 'bg-warning'
                                        : ($isCurrentUser
                                            ? 'bg-success'
                                            : 'bg-secondary');
                                @endphp

                                <!-- Label Tanggal -->
                                @if ($logDate !== $currentDate)
                                    <div class="time-label">
                                        <span class="bg-danger text-white px-2 py-1 rounded">{{ $logDate }}</span>
                                    </div>
                                    @php $currentDate = $logDate; @endphp
                                @endif

                                <!-- Timeline Item -->
                                <div>
                                    <i class="fas fa-user {{ $iconColor }}"></i>
                                    <div class="timeline-item shadow-sm"
                                        style="background-color: {{ $bubbleColor }}; color: {{ $textColor }}; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                        
                                        <!-- Waktu -->
                                        <span class="time text-bold">
                                            <i class="fas fa-clock"></i> {{ $log->created_at->format('H:i') }}
                                        </span>
                                
                                        <!-- Nama User & Aksi -->
                                        <h3 class="timeline-header">
                                            <a href="#" class="text-primary">
                                                {{ $log->user->name ?? 'Unknown User' }} ({{ $log->user->status }})
                                            </a>
                                            {{ $log->action }}
                                        </h3>
                                
                                        <!-- Tombol Collapse untuk Menampilkan Detail -->
                                        <button class="btn btn-sm btn-outline-primary mt-2 mx-3" type="button" data-toggle="collapse" 
                                            data-target="#timeline-body-{{ $log->id }}">
                                            Lihat Detail
                                        </button>
                                
                                        <!-- Timeline Body (Hidden by Default) -->
                                        <div class="collapse mt-2" id="timeline-body-{{ $log->id }}">
                                            <div class="timeline-body bg-white p-2 rounded shadow-sm">
                                                <div class="border-left border-primary pl-3">
                                                    <strong class="text-dark">Topik: </strong>
                                                    <span class="text-primary">
                                                        {{ optional($log->report->topic)->name ?? ($log->report->custom_topic ?? 'Topik Tidak Diketahui') }}
                                                    </span><br>
                                                    <strong class="text-dark">Deskripsi: </strong>
                                                    <span class="text-muted">
                                                        {{ $log->report->description ?? 'Deskripsi tidak tersedia' }}
                                                    </span>
                                                </div>
                                            </div>
                                
                                            <!-- Tombol untuk Bukti -->
                                            <div class="timeline-footer mt-2">
                                                <button class="btn btn-sm btn-dark" type="button" data-toggle="collapse"
                                                    data-target="#proof-{{ $log->id }}">
                                                    Lihat Bukti
                                                </button>
                                                <div class="collapse mt-2" id="proof-{{ $log->id }}">
                                                    @if ($log->report && $log->report->file_proof)
                                                        <img src="{{ asset('images/report_files/' . $log->report->file_proof) }}" class="img-fluid rounded shadow">
                                                    @else
                                                        <p class="text-muted">Tidak ada bukti tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                </div>                                
                            @endforeach

                            <!-- Akhir timeline -->
                            <div><i class="fas fa-clock bg-gray"></i></div>
                        </div>
                    </div>

                    <!-- Grafik Laporan -->
                    <div class="col-md-4">
                        <div class="row-md-4">
                            <div class="col">
                                <div class="card shadow-lg rounded-lg mt-4" style="height: 320px;">
                                    <div class="card-header bg-success text-white">
                                        <h3 class="card-title m-0">Grafik Jumlah Laporan Per Sistem</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chartLaporan"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card shadow-lg rounded-lg mt-4" style="height: 320px;">
                                    <div class="card-header bg-success text-white">
                                        <h3 class="card-title m-0">Grafik Jumlah Laporan Per Topik</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="topikChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
