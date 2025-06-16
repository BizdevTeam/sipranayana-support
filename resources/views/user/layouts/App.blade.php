<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    @include('user.includes.style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{--  <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/UserLTELogo.png" alt="UserLTELogo" height="60" width="60">
        </div>  --}}

        <!-- Navbar -->
        @include('user.includes.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('user.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        @include('user.includes.footer')
        <!-- ./wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- jQuery -->
    @include('user.includes.script')

    <script>
        $(document).ready(function () {
            $('#example2').DataTable({
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari data...",
                    paginate: {
                        previous: "<i class='bi bi-chevron-left'></i>",
                        next: "<i class='bi bi-chevron-right'></i>"
                    }
                }
            });
        });
    
        function toggleCustomTopic(select) {
            const customTopicField = document.getElementById('customTopicField');
            if (select.value === 'other') {
                customTopicField.style.display = 'block';
                document.getElementById('customTopic').setAttribute('required', 'required');
            } else {
                customTopicField.style.display = 'none';
                document.getElementById('customTopic').removeAttribute('required');
            }
        }
    </script>    
</body>

</html>
