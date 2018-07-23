<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>業務 DSR 報告</title>

    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- DataTables CSS
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"> -->

    <!-- DataTables Responsive CSS
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    .tab-pane { margin-top: 70px; margin-left: 10px; margin-right: 10px; }
    .number_field { text-align: right; }
    table { table-layout: fixed; background-color: white; font-size: 1.2em; }
    </style>
</head>
<body>
    @yield('content')

    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <!--<script src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>-->
    <!--<script src="{{ asset('/js/dataTables.responsive.js') }}"></script>-->

    <!-- Custom Theme JavaScript
    <script src="{{ asset('/js/sb-admin-2.js') }}"></script> -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#cus_table').DataTable({
            responsive: true,
            paging: false
        });
    });
    </script>

</body>
</html>
