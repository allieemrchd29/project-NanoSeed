<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nanoseed Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">

    <link rel="stylesheet" href="{{ asset('assets/dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/tabler-vendors.min.css') }}">

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        :root {
            --tblr-font-sans-serif: 'Inter var', -apple-system, sans-serif;
        }

        body {
            font-family: var(--tblr-font-sans-serif);
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class="antialiased">

    <div class="page">
        {{-- Konten Dashboard --}}
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js" defer></script>

    <script src="{{ asset('assets/dist/js/tabler.min.js') }}" defer></script>

</body>

</html>
