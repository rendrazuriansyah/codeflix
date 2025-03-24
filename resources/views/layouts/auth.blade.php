<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Codeflix</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-free/all.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

    <!-- Font Awesome 6.6.0 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.6.0-web/css/all.min.css') }}">

    <!--
        This is the main layout for all the authentication pages.
        The content for each page is yielded in the @section('content') block.
    -->
</head>

<body>
    <div class="container-fluid bg-login">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-4 col-md-6 offset-md-6">
                <div class="text-center">
                    <!-- Codeflix Logo -->
                    <img src="{{ asset('assets/img/codeflix_logo.png') }}" class="codeflix-title" alt="Codeflix Logo">
                    <!-- Page Title -->
                    <h3 class="codeflix-sign-in">@yield('page-title')</h3>
                </div>
                <!-- Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Page Scripts -->
    @yield('scripts')
</body>

</html>
