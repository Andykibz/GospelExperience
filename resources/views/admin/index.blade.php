<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravels') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/geadmin.css') }}">
        <link rel="stylesheet" href="{{ asset('lib/fontawesome-free/css/all.min.css') }}">
        @stack('adminstyles')


    </head>
    <body>

      <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

          @include('admin.partials.sidebar')
          <!-- Content Wrapper -->
          <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

              <!-- Topbar -->
              <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                </button>

                @component('admin.components.search')

                @endcomponent

                @include('admin.partials.topbar-nav')

              </nav>
              <!-- End of Topbar -->

              <!-- Begin Page Content -->
              <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-gray-800">@yield('page-heading','Dashboard')</h1>
                  {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
                  <div class="">
                    @yield('header-right')
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    @include('admin.components.flash-message')

                  </div>

                </div>

                @yield('content')
              </div>
              <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('admin.partials.footer', ['some' => 'data'])
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/sb-admin-2.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/jquery.easing.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/admin.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/geadmin.js') }}" type="text/javascript">

          </script>
          @stack('adminscripts')


    </body>
</html>
