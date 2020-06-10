<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Silsilah dan Marga</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{!! asset('public\assets\ionic.css') !!}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/theme/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/summernote/summernote-bs4.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{!! asset('public\assets\DataTables\datatables.min.css') !!}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  @include('sweetalert::alert')
  @include('layout.header')
  @include('layout.side')
  
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$page->title ?? ''}}</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> -->
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div> 
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>

  @include('layout.footer')

</div>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('public/theme/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('public/theme/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('public/theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('public/theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('public/theme/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('public/theme/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('public/theme/dist/js/demo.js') }}"></script>
<script src="{!! asset('public\assets\DataTables\datatables.min.js') !!}"></script>
<script src="{{ asset('public/theme/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('public/theme/plugins/toastr/toastr.min.js')}}"></script> 
<script src="{{ asset('public/theme/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('public/theme/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('public/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>


</body>
</html>
