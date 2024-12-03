<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Meta-Link -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="">
    <meta name="mlapplication-tap-highlight" content="no">

    <!-- Title -->
    <title>@yield('title')</title>
    <!-- FaveIcon-Link -->
    <link rel="shortcut icon" href="{{ $app_setting['favicon'] }}" type="image/x-icon">
    <!-- Bootstrap-Min-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font-Awesome--Min-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <!--Bootstrap-Icon-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <!--ApexChart-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <!--DataTables--Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <!--Style--Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!--Responsive--Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    @stack('styles')
</head>

<body>
    <!-- App-Container-Section -->
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" id="appContent">

        <!-- storage link -->
        @if ($storageLink)
            <div class="w-100" style="z-index: 99; position: fixed; top: 0;">

                <div class="alert alert-primary alert-dismissible fade show mb-0 w-100 text-center rounded-0 text-black"
                    role="alert" style="padding: 10px">
                    <strong><i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="bottom"
                            title='If you can not install storage link, then image not found.'></i>
                        Storage link dose not exist or image not found then</strong> please run <code
                        class="text-danger">php
                        artisan
                        storage:link</code> or <a href="{{ route('link.storage') }}" class="btn btn-sm btn-dark">
                        Click Here</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                        id="closeAlert"></button>
                </div>

            </div>
        @endif
        @include('layouts.header')
        @include('layouts.theme')
        <div class="app-main">
            @include('layouts.sidebar')
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
    <!-- End-App-Container-Section  -->

    <!-- Jquery-link -->
    <script src="{{ asset('assets/scripts/jquery-3.6.3.min.js') }}"></script>
    <!-- Main-Script-Js-Link -->
    <script src="{{ asset('assets/scripts/main.js') }}"></script>
    <!-- Bootstrap-Min-Bundil-Link -->
    <script src="{{ asset('assets/scripts/bootstrap.bundle.min.js') }}"></script>
    <!-- Font-Awesome-Min-Js-Link-->
    <script src="{{ asset('assets/scripts/font-awesome.min.js') }}"></script>
    <!-- Full-Screen-Js-Link -->
    <script src="{{ asset('assets/scripts/full-screen.js') }}"></script>
    <!-- Sweet-Alert-link -->
    <script src="{{ asset('assets/scripts/sweetalert2.min.js') }}"></script>
    <!-- DataTables-Js-Link -->
    <script src="{{ asset('assets/scripts/datatables.min.js') }}"></script>
    <!--Script-Js-Link -->
    <script src="{{ asset('assets/scripts/scripts.js') }}"></script>

    {{-- Sweet Alert --}}
    <script>
        function deleteAction(deleteUrl) {
            Swal.fire({
                title: "Are you sure?",
                text: "The instence and it's realted data will be deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(deleteUrl);
                }
            });
        }
    </script>

    <script>
        function sureAction(submitUrl) {
            Swal.fire({
                title: "Are you sure?",
                text: "Please confirm that you understand this course will be offered free of charge",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(submitUrl);
                }
            });
        }
    </script>
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif
    @stack('scripts')

</body>

</html>