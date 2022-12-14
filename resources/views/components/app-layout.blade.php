<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $title }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @yield("custom-heads")
</head>

<body class="sb-nav-fixed">
    @include('sweetalert::alert')
    <x-navbar></x-navbar>
    <div id="layoutSidenav">
        <x-sidebar></x-sidebar>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">{{ $title }}</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">{{ $description ?? "-" }}</li>
                    </ol>
                    <x-alert></x-alert>
                    {{ $slot }}
                </div>
            </main>

            <x-footer></x-footer>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/app-layout.js') }}"></script>
    @yield("custom-scripts")
</body>

</html>
