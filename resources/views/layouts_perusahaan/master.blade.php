<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page-title', 'Manajemen Perpustakaan')</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <style>
        .bg-biru-koneks {
            background-color: #0b5ed7
        }
    </style>
    <script>
        function confirmLogout() {
            let keluar = confirm("Yakin Anda ingin logout?");
            if (keluar) {
                window.location.href = "http://127.0.0.1:8000/login-penyedia/";
            }
        }
    </script>
    {{-- memanggil section styles dari masing" halaman --}}
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 position-absolute w-100 bg-biru-koneks"></div>
    {{-- memanggil/include file sidebar untuk menerapkan desainnya disini --}}
    @include('layouts_perusahaan.sidebar')

    <main class="main-content position-relative border-radius-lg ">
        {{-- untuk menerapkan navbarnya, makanya menggunakan include --}}
        @include('layouts_perusahaan.navbar')

        <div class="container-fluid py-4">
            {{-- memanggil section content dari masing" halaman --}}
            @yield('content')
        </div>
    </main>

    {{-- memanggil section script dari masing" halaman --}}
    @yield('scripts')
</body>

</html>
