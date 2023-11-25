<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Oprah Pharmacie">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Accès Interdit')</title>


    <!-- Favicon and touch Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicons/site.webmanifest') }}">
    <!-- Styles Include -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" id="stylesheet">

</head>

<body class="bg-primary">
<!-- Preloader -->
<div id="preloader">
    <div class="preloader-inner">
        <div class="spinner"></div>
        <div class="logo"><img  src="{{ asset('assets/favicons/favicon.ico') }}" alt="img"></div>
    </div>
</div>

<div class="row">
    <div class="col-xl-7 col-lg-7 col-md-6">
        <div class="d-none d-md-flex align-items-center justify-content-center" style="height: calc(100vh - 100px);">
            <img src="{{ asset('assets/favicons/apple-touch-icon.png') }}" alt="img" class="img-fluid">
        </div>
    </div>

    <div class="col-xl-5 col-lg-5 col-md-6">
        <div class="d-flex align-items-center justify-content-center vh-100 bg-white">
            <div class="card rounded-0 border-0 p-5 m-0 w-100">

                <div class="card-header border-0 p-0">
                    <h1 class="fs-150 lh-150 text-danger text-shadow-404">403</h1>
                    <h2>Accès Interdit !</h2>
                    <p class="text-dark mt-4 mb-5">{{ $exception->getMessage() }}</p>
                </div>

                <div class="card-body p-0">
                    <a href="{{ route('app.home') }}" class="btn btn-sm btn-primary  text-white rounded-2 lh-34 ff-heading fw-bold shadow">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Core JS -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- jQuery UI Kit -->
<script src="{{ asset('assets/plugins/jquery_ui/jquery-ui.1.12.1.min.js') }}"></script>

<!-- Snippets JS -->
<script src="{{ asset('assets/js/snippets.js') }}"></script>

<!-- Theme Custom JS -->
<script src="{{ asset('assets/js/theme.js') }}"></script>

</body>

</html>
