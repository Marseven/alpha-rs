<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Alpha</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/LogoRSA.png')}}">
	<link href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">

            @include('layouts.flash')

             @yield('content')

        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('admin/vendor/global/global.min.js')}}"></script>
	<script src="{{ asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('admin/js/custom.min.js')}}"></script>
    <script src="{{ asset('admin/js/deznav-init.js')}}"></script>

    <script src="{{ asset('admin/js/styleSwitcher.js')}}"></script>
</body>

<!-- Mirrored from mediqu.dexignzone.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Jul 2021 09:26:37 GMT -->
</html>
