<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <title>@yield('title', 'Nanoseed')</title>


  <link rel="stylesheet" href="{{ asset('assets/css/tabler.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tabler-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/nanoseed.css') }}">
  
  @stack('styles')
</head>

    <div class="page-wrapper">
      @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="footer footer-transparent d-print-none">
      <div class="container-xl">
        <div class="row text-center align-items-center">
          <div class="col-lg-auto">
            &copy; {{ date('Y') }} <strong>Nanoseed</strong>. All rights reserved.
          </div>
        </div>
      </div>
    </footer>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js" defer></script>
  {{-- <script src="{{ asset('assets/dist/js/tabler.min.js') }}" defer></script> --}}


  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js" defer></script>
  <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js" defer>
  </script>
  <script src="https://unpkg.com/filepond/dist/filepond.js" defer></script>
  @stack('scripts')
</body>
</html>