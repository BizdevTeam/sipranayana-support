<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    @include('admin.includes.style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{--  <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>  --}}

        <!-- Navbar -->
        @include('admin.includes.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        @include('admin.includes.footer')
        <!-- ./wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- jQuery -->
    @include('admin.includes.script')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctxLaporan = document.getElementById("chartLaporan").getContext("2d");
            const ctxTopik = document.getElementById("topikChart").getContext("2d");
        
            const colors = [
                "#007bff", "#dc3545", "#ffc107", "#28a745",
                "#17a2b8", "#6610f2", "#e83e8c", "#fd7e14"
            ];
        
            const dataLaporan = {
                labels: @json($reportsBySystem->pluck('system.name')),
                datasets: [{
                    label: "Jumlah Laporan",
                    data: @json($reportsBySystem->pluck('total')),
                    backgroundColor: colors,
                    borderColor: "#ffffff",
                    borderWidth: 1,
                    hoverOffset: 10
                }]
            };
        
            const dataTopik = {
                labels: @json($reportsByTopics->pluck('topic.name')),
                datasets: [{
                    label: "Jumlah Laporan",
                    data: @json($reportsByTopics->pluck('total')),
                    backgroundColor: colors,
                    borderColor: "#ffffff",
                    borderWidth: 1,
                    hoverOffset: 10
                }]
            };
        
            // Pie Chart untuk laporan per sistem
            new Chart(ctxLaporan, {
                type: "pie",
                data: dataLaporan,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        animateScale: true
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: "Distribusi Laporan Berdasarkan Sistem",
                            font: {
                                size: 16,
                                weight: "bold"
                            },
                            padding: 20
                        },
                        legend: {
                            position: "right",
                            labels: {
                                font: {
                                    size: 14
                                },
                                padding: 15
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    let value = tooltipItem.raw;
                                    return `${tooltipItem.label}: ${value} Laporan`;
                                }
                            }
                        }
                    }
                }
            });
        
            // Bar Chart untuk laporan berdasarkan topik
            new Chart(ctxTopik, {
                type: "pie",
                data: dataTopik,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Jumlah Laporan",
                                font: {
                                    size: 14,
                                    weight: "bold"
                                }
                            },
                            ticks: {
                                precision: 0
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: "Topik Laporan",
                                font: {
                                    size: 14,
                                    weight: "bold"
                                }
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: "Distribusi Laporan Berdasarkan Topik",
                            font: {
                                size: 16,
                                weight: "bold"
                            },
                            padding: 20
                        },
                        legend: {
                            display: false // Karena Bar Chart biasanya lebih jelas tanpa legend
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    let value = tooltipItem.raw;
                                    return `Jumlah Laporan: ${value}`;
                                }
                            }
                        }
                    }
                }
            });
        });
            
    </script>
    
</body>

</html>
