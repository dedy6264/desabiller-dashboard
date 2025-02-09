<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{strtoupper(request()->path())}} Dashboard {{ env('THEME_TITLE') }}</title>
<!-- {{-- {{dd(request())}} --}} -->
    <!-- Custom fonts for this template-->
    <link href="{{url('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @yield('customLink')

</head>
<body id="page-top" class="sidebar-toggled">
    <!-- Page Wrapper -->
    <div id="app">
    <div id="wrapper">

        <!-- Sidebar -->
        <!-- @yield("activeMenu") -->
        @include("dashboard.sidebar")
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include("dashboard.topbar")
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield("pageheading")

                    <!-- Content Row -->
                    @yield("content")
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
             <!-- Footer -->
             @include("dashboard.footer")
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
    @yield('script')
    <!-- Bootstrap core JavaScript-->
    <script src="{{url('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{url('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="{{url('admin/js/sb-admin-2.min.js')}}"></script>
    @yield('customScript')

</body>

</html>