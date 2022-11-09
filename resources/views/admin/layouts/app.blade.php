<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Saudi Digital Dentistry Club') }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link href="{{asset('portal/global_assets/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('portal/global_assets/css/icons/fontawesome/styles.min.css')}}" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <link href="{{asset('portal/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('portal/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('portal/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('portal/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.13/css/tableexport.css" rel="stylesheet"
          type="text/css">
    <!-- /global stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous"/>

    <!-- Custom Style -->
    <link href="{{asset('portal/assets/css/custom.css?v=1')}}" rel="stylesheet" type="text/css">

    <!-- Core JS files -->
    <script src="{{asset('portal/global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{asset('portal/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('portal/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4EDe8fKdumTQCekY9kK7iZqfUqEAjccE&libraries=&v=weekly&language=en&region=SA"></script>
    <script src="{{asset('portal/assets/js/app_js.js?v=1')}}"></script>

    <!-- Theme JS files -->
    <script src="{{asset('portal/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('portal/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('portal/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script src="{{asset('portal/global_assets/js/demo_pages/components_dropdowns.js')}}"></script>


    <script src="{{asset('portal/global_assets/js/demo_pages/form_layouts.js')}}"></script>

    <!-- /theme JS files -->

    <style>
        .table th{
            font-weight: bold;
        }
    </style>
@yield('js_css_header')


</head>

<body class="navbar-top">



{{--<div id="loading_overlay"  v-if="isLoading">--}}

{{--    <div class="loading_container">--}}
{{--        <img style="width: 80px;"--}}
{{--             src="{{ asset('portal/assets/images/logo.png') }}">--}}
{{--        <p>please wait ...</p>--}}
{{--        <i class="fas fa-spin fa-spinner"></i>--}}

{{--    </div>--}}
{{--</div>--}}

<div id="app">
    <notify></notify>

    <!-- Main navbar -->
@include('admin.layouts.navbar')
<!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
    @include('admin.layouts.sidebar')
    <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper" style="    overflow: hidden;">

            <!-- Content area -->
            <loader :is-visible="isLoading"></loader>

            <router-view></router-view>
            <!-- /content area -->

            <!-- Footer -->
        @include('admin.layouts.footer')
        <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
</div>
<script src="{{ asset('portal/assets/js/pnotify.min.js') }}" defer></script>

{{--<script src="{{ asset('js/manifest.js?version='.now()) }}" defer></script>--}}
{{--<script src="{{ asset('js/vendor.min.js?version='.now()) }}" defer></script>--}}
<script src="{{ asset('js/app.js?version='.now()) }}" defer></script>

<!-- /page content -->
@yield('js_assets')
@yield('js_code')
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').on('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            console.log('clicked')
            // Remove "show" class in all siblings
            $(this).parent().siblings().removeClass('show').find('.show').removeClass('show');

            // Toggle submenu
            $(this).parent().toggleClass('show').children('.dropdown-menu').toggleClass('show');

            // Hide all levels when parent dropdown is closed
            $(this).parents('.show').on('hidden.bs.dropdown', function (e) {
                $('.dropdown-toggle .show, .dropdown-toggle.show').removeClass('show');
            });
        });
    })

</script>
</body>
</html>
