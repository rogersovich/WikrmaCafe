<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>

        .container-cus{
            width: 100%;
            /* padding-right: 15px; */
            /* padding-left: 15px; */
        }

        .nav-custom-1{
            background-color: #706FD3;
            max-height: 70px;
        }

        .nav-custom-2{
            background-color: #706FD3;
            border-bottom: 1px #dedede solid;
            max-height: 70px;
        }

        .inline-text-1{
            display: inline-block;
        }

        .f-purple{
            color: #706FD3;
        }

        .f-white{
            color: #f3f3f3;
        }

        .f-broken-white{
            color: #ebebeb;
        }

        .f-yellow{
            color: #FED330;
        }

        .f-dark-light{
            color: #525f7f;
        }

        .f-blue{
            color: #4b7bec;
        }

        .f-black{
            color: #000000;
        }

        .btns-dark {
            background-color: #3d3d3d;
        }

        .btns-broken-white {
            background-color: #f3f3f3;
        }

        .bg-table-isactive{
            border: 2px #706FD3 solid;
            background: #f3f3f3;
        }

        .bg-silver-dark{
            background-color: #ebebeb;
        }

        .bg-silver{
            background-color: #DEDEDE;
        }

        .bg-broken-white{
            background-color: #f3f3f3;
        }

        .mt-50{
            margin-top: 50px;
        }

        .mt-70{
            margin-top: 70px;
        }

        .mt-100{
            margin-top: 100px;
        }


        .pt-50{
            padding-top: 50px;
        }

        .pt-70{
            padding-top: 70px;
        }

        .pt-100{
            padding-top: 100px;
        }

        .pt-150{
            padding-top: 150px;
        }

        .pt-200{
            padding-top: 200px;
        }

        .pl-100{
            padding-left: 100px;
        }

        .pl-80{
            padding-left: 80px;
        }

        .pl-90{
            padding-left: 90px;
        }

        .pl-50{
            padding-left: 50px;
        }

        .bd-dark{
            border: 1px #3d3d3d solid;
        }

        .bg-primary-custom{
            background: #706FD3;
        }

        .p-custom-box{
            padding: 1.5rem !important;
        }

        .bg-img{
            height: auto;
            width: 100%;
            background-position: center;
            background-size: cover;
        }

    </style>

    @yield('custom-css')

    <link href="{{ asset('/assets/img/logo_compact.png') }}" rel="icon" type="image/png" sizes="16x16">

    <link href="{{ asset('assets/argon/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/argon/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/argon/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/picker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/argon/css/font-open-sans.css') }}" rel="stylesheet">

    <title>@yield('title')</title>

</head>
<body class="bg-broken-white">

    <div class="main-content">
        @section('content')

        @show
    </div>

    {{-- all jquery --}}
    <script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
    <!--   Core   -->
    <script src="{{ asset('assets/argon/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/argon/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/picker.js') }}"></script>
    <!--   Optional JS   -->
    <script src="{{ asset('assets/argon/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/argon/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
    <!--   Argon JS   -->
    <script src="{{ asset('assets/argon/js/argon-dashboard.min.js') }}"></script>
    <script src="{{ asset('assets/argon/js/track-js.js') }}"></script>

    <script src="{{ asset('assets/js/sweetalert2.all.js') }}"></script>


    @yield('scripts')

</body>
</html>

