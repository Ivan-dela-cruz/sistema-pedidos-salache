<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_page')</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}"/>
    <!-- PLUGINS STYLES-->
    <link rel="stylesheet" href="{{asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css')}}"/>
    <!-- THEME STYLES-->
    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendors/DataTables/datatables.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('sweetalert2/dist/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/jquery.passwordRequirements.css')}}" />


</head>

<body class="fixed-navbar">
<div class="page-wrapper">

    @include('admin.base.header')


    @include('admin.base.sidebar')

    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            @yield('content')
        </div>
        @include('admin.base.footer')
    </div>
</div>
@include('admin.base.theme')

<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->



<!-- CORE PLUGINS-->
<script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/metisMenu/dist/metisMenu.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="{{asset('assets/vendors/chart.js/dist/Chart.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js')}}" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="{{asset('assets/js/app.min.js')}}" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->

<script src="{{asset('sweetalert2/dist/sweetalert2.all.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/axios.min.js')}}" type="text/javascript"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>

</script>
<!-- PAGE LEVEL SCRIPTS-->
<script type="text/javascript">
    $(function () {
        $('#example-table').DataTable({
            pageLength: 10,
            //"ajax": './assets/demo/data/table_data.json',
            /*"columns": [
                { "data": "name" },
                { "data": "office" },
                { "data": "extn" },
                { "data": "start_date" },
                { "data": "salary" }
            ]*/
        });
    })
</script>
@yield('scripts')

</body>
</html>
