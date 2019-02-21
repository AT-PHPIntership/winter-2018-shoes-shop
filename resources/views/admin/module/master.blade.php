<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shoes Shop</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{!! asset('admin/css/bootstrap.min.css') !!}">
    <!-- Date-Picker -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-datepicker.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('admin/css/font-awesome.min.css') !!}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! asset('admin/css/select2.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('admin/css/AdminLTE.min.css') !!}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{!! asset('admin/css/_all-skins.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/css/style.css') !!}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Insert header page -->
    @include('admin.module.header')
    <!-- Insert Sidebar -->
    @include('admin.module.sidebar')
    <!-- Insert content -->
    @yield('content')
    <!-- Insert footer -->
    @include('admin.module.footer')

    <!-- jQuery 3 -->
    <script src="{!! asset('admin/js/jquery.min.js') !!}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{!! asset('admin/js/jquery-ui.min.js') !!}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{!! asset('admin/js/bootstrap.min.js') !!}"></script>
    <!-- Date-Picker -->
    <script src="{{ asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Chart -->
    <script src="{{ asset('admin/js/Chart.js') }}"></script>
    <script src="{{ asset('admin/js/order-chart.js') }}"></script>
    <!-- Select2 -->
    <script src="{!! asset('admin/js/select2.full.min.js') !!}"></script>
    <!-- AdminLTE App -->
    <script src="{!! asset('admin/js/adminlte.min.js') !!}"></script>
    <script src="{!! asset('admin/js/main.js') !!}"></script>
</body>
</html>
