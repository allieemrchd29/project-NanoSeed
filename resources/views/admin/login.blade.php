<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <title>Login Nanoseed Admin</title>

  <link rel="stylesheet" href="{{ asset('assets/css/tabler.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tabler-vendors.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">

  <style>
    /* Menggunakan font Inter bawaan Tabler */
    @import url('https://rsms.me/inter/inter.css');
    :root { --tblr-font-sans-serif: 'Inter var', sans-serif; }
    body { 
      background: #f1f5f9; 
      font-family: var(--tblr-font-sans-serif);
      font-feature-settings: "cv03", "cv04", "cv11";
    }
    .brand-logo { font-size: 2rem; }
  </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">

  <div class="page page-center">
    <div class="container container-tight py-4">

      {{-- Logo / Brand --}}
      <div class="text-center mb-4">
        <div class="brand-logo mb-2">🌱</div>
        <h1 class="fw-bold fs-2 mb-0">Nanoseed</h1>
        <p class="text-muted">Admin Panel</p>
      </div>

      {{-- Card Login --}}
      <div class="card card-md shadow-sm">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Masuk ke Dashboard</h2>

          {{-- Pesan Error --}}
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mb-3" role="alert">
              <div class="d-flex">
                <div>{{ $errors->first() }}</div>
              </div>
              <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
          @endif

          {{-- Form Login --}}
          <form action="{{ route('admin.login.post') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
              <label class="form-label required">Email</label>
              <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="admin@nanoseed.com"
                value="{{ old('email') }}"
                required
              >
            </div>

            <div class="mb-2">
              <label class="form-label required">Password</label>
              <div class="input-group input-group-flat">
                <input
                  type="password"
                  name="password"
                  id="passwordInput"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="Password kamu"
                  required
                >
                <span class="input-group-text">
                  <a href="javascript:void(0)" class="link-secondary" title="Lihat password" onclick="togglePassword()">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                      stroke-width="2" stroke="currentColor" fill="none">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                      <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                  </a>
                </span>
              </div>
            </div>

            <div class="form-footer mt-4">
              <button type="submit" class="btn btn-success w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                  <path d="M20 12h-13l3 -3m0 6l-3 -3" />
                </svg>
                Masuk
              </button>
            </div>

          </form>
        </div>
      </div>

      <div class="text-center text-muted mt-3 small">
        &copy; {{ date('Y') }} <strong>Nanoseed</strong>. All rights reserved.
      </div>

    </div>
  </div>

  <script src="{{ asset('assets/dist/js/tabler.min.js') }}" defer></script>
  
  <script>
    function togglePassword() {
      const input = document.getElementById('passwordInput');
      input.type = input.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>
</html>