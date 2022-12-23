<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ asset('mazer/assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/main/app-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <link rel="shortcut icon" href="{{ asset('mazer/assets/images/logo/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('mazer/assets/images/logo/favicon.png') }}" type="image/png" />

    <link rel="stylesheet" href="{{ asset('mazer/assets/css/shared/iconly.css') }}" />

    @yield("custom-heads")
</head>

<body>
    <script src="assets/js/initTheme.js"></script>
    @include('sweetalert::alert')
    <div id="app">

        <x-dashboard.sidebar></x-dashboard.sidebar>


        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>{{ $title }}</h3>
            </div>

            <x-alert></x-alert>



            <div class="page-content">
                {{ $slot }}
            </div>

            <x-dashboard.footer></x-dashboard.footer>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/app-layout.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/app.js') }}"></script>
    @yield("custom-scripts")
    <!-- Need: Apexcharts -->
    {{-- <script src="{{ asset('mazer/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/pages/dashboard.js') }}"></script> --}}
</body>

</html>
