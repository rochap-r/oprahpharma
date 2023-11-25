<!doctype html>
<html lang="fr">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Oprah Pharmacie">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Oprah Pharmarcie')</title>


    <!-- Favicon and touch Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicons/site.webmanifest') }}">
    <!-- Styles Include -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" id="stylesheet">

    <!-- ijabo CSS pour le tostAlert -->
    <link href="{{ asset('assets/ijaboCropTool/ijabo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/ijaboCropTool/ijaboCropTool.min.css') }}" rel="stylesheet" />

    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <!-- Ajoutez le CSS de Selectize.js ici -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.css" rel="stylesheet">

    <!--livewire style-->
    @livewireStyles
    <!--end livewire style-->

    <style>
        #toast-container .toast-success {
            background: #28a745 !important;
        }

        #toast-container .toast-info {
            background: #17a2b8 !important;
        }

        #toast-container {
            font-weight: bold;
            font-size: 1.5rem;

        }

        #toast-container .toast-error {
            background: #dc3545 !important;
        }
    </style>
    @stack('style')
</head>
<body class="bg-light">

<!-- Preloader -->
<div id="preloader" class="hide">
    <div class="preloader-inner">
        <div class="spinner"></div>
        <div class="logo"><img src="{{ asset('assets/favicons/favicon.ico') }}" alt="img"></div>
    </div>
    <div class="hide-loader">Hide Preloader</div></div>

<!-- Default Nav -->
@include('components.header')

<!-- Horizontal Nav -->
<!-- Combo Nav -->
<!-- Vertical Nav -->
@include('components.navbar')

<!-- Theme Customizer Panel -->
<x-setting/>

<!-- Header Modal Search -->
<x-search/>

<!-- Main Wrapper-->
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">

            @yield('content')

        </div>
    </div>
</main>





<!-- Core JS -->
<script src="{{ asset('assets/ijaboCropTool/jquery-3.6.3.min.js') }}"></script>
<!--<script src="assets/js/jquery-3.6.0.min.js') }}"></script>-->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- jQuery UI Kit -->
<script src="{{ asset('assets/plugins/jquery_ui/jquery-ui.1.12.1.min.js') }}"></script>

<!-- ApexChart-->

<!-- Peity  -->
<script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/plugins/peity/piety-init.js') }}"></script>

<!-- Select 2 et selectize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>


<!-- Datatables -->
<script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/js/datatables.init.js') }}"></script>



<!-- Date Picker -->
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>

<!-- Dropzone -->
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone_custom.js') }}"></script>

<!-- TinyMCE -->
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/plugins/prism/prism.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-repeater/jquery.repeater.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2-init.js') }}"></script>

<!-- Snippets JS -->
<script src="{{ asset('assets/js/snippets.js') }}"></script>

<!-- Theme Custom JS -->
<script src="{{ asset('assets/js/theme.js') }}"></script>


<!-- ijabo JS et JQ pour le toastAlert -->
<script src="{{ asset('assets/ijaboCropTool/ijabo.min.js') }}"></script>
<script src="{{ asset('assets/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
<script src="{{ asset('assets/ijaboViewer/jquery.ijaboViewer.min.js') }}"></script>



<!-- plugins JS -->
@stack('script')
<!--livewire-->
@livewireScripts
<!--livewire-->
<!-- ijabo JS et JQ pour le toastAlert -->
<script>
    window.addEventListener('showToastr', function(event) {
        toastr.remove()
        if (event.detail.type === 'info') {
            toastr.info(event.detail.message);
        } else if (event.detail.type === 'success') {
            toastr.success(event.detail.message);
        } else if (event.detail.type === 'error') {
            toastr.error(event.detail.message);
        } else if (event.detail.type === 'warning') {
            toastr.warning(event.detail.message);
        } else {
            return false;
        }

    });
</script>



</body>
</html>
