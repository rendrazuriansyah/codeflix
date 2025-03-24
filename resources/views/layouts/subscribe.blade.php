<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>@yield('title') - Codeflix</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.6.0-web/css/all.min.css') }}">
    <style>
        body {
            background-color: #132029;
            color: white;
        }

        .card {
            background-color: #142936;
            border: 1px solid #19BC9B;
            border-radius: 15px;
        }

        .card-header {
            background-color: #19BC9B;
            border-bottom: 1px solid #19BC9B;
        }

        .text-green {
            color: #19BC9B;
        }

        .btn-green {
            background-color: #19BC9B;
            border-color: #19BC9B;
            color: #1a1d21;
        }

        .btn-green:hover {
            background-color: #132029;
            border-color: #19BC9B;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <!-- Page title -->
        <h2 class="mb-2 text-center">@yield('page-title')</h2>

        <!-- Page content -->
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Page scripts -->
    @yield('scripts')
</body>

</html>

