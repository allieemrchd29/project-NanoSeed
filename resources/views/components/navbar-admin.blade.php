<style>
    :root {
        --tblr-primary: #198f2c;
        --tblr-navbar-active-border-color: #198f2c;
    }

    .nav-item.active .nav-link,
    .nav-item.active .nav-link-icon,
    .nav-item.active .nav-link-title {
        color: #198f2c !important;
        font-weight: 600;
    }

    .notif-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        min-width: 18px;
        height: 18px;
        padding: 0 4px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
        line-height: 18px;
        text-align: center;
        background: #d63939;
        color: #fff;
        display: none;
    }

    .notif-dropdown {
        width: 360px;
        max-height: 480px;
        overflow: hidden;
        border-radius: 8px;
        padding: 0;
    }

    .notif-list {
        max-height: 360px;
        overflow-y: auto;
    }

    .notif-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 16px;
        border-bottom: 1px solid #e6e7e9;
        cursor: pointer;
        transition: background .15s;
    }

    .notif-item:hover {
        background: #f4f6fa;
    }

    .notif-item.unread {
        background: #eef5ff;
    }

    .notif-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #206bc4;
        flex-shrink: 0;
        margin-top: 6px;
    }
</style>

{{-- Brand + Notif + Avatar --}}
<header class="navbar navbar-expand-md d-print-none sticky-top">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <span class="fs-2">NanoSeed</span>
        </h1>

        <div class="navbar-nav flex-row order-md-last">

            {{-- Search --}}
            <div class="nav-item d-none d-md-flex me-3">
                <form action="{{ route('admin.search') }}" method="GET" class="d-flex">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" name="q" class="form-control" placeholder="Cari..."
                            aria-label="Search">
                    </div>
                </form>
            </div>

            {{-- Notifikasi --}}
            <div class="nav-item dropdown me-3">
                <a href="#" class="nav-link px-0 position-relative"
                   data-bs-toggle="dropdown"
                   data-bs-auto-close="outside"
                   id="notif-toggle"
                   aria-label="Notifikasi">
                    <i class="ti ti-bell icon"></i>
                    <span class="notif-badge" id="notif-badge">0</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end notif-dropdown shadow">

                    {{-- Header dropdown --}}
                    <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                        <span class="fw-bold" style="font-size:14px;">Notifikasi</span>
                        <button type="button" class="btn btn-sm btn-ghost-secondary" id="btn-mark-all"
                                style="font-size:12px; padding: 2px 8px;">
                            Tandai semua dibaca
                        </button>
                    </div>

                    {{-- List --}}
                    <div class="notif-list" id="notif-list">
                        <div id="notif-empty" class="text-center py-4 text-muted">
                            <i class="ti ti-bell-off mb-1" style="font-size:28px; display:block;"></i>
                            <div class="small">Tidak ada notifikasi baru</div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="border-top text-center py-2">
                        <a href="{{ route('admin.notifications.index') }}" class="small fw-medium" style="color:#206bc4;">
                            Lihat semua notifikasi
                        </a>
                    </div>

                </div>
            </div>

            {{-- Profile Dropdown --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">

                    @if (auth('admin')->user()->profile)
                        <span class="avatar avatar-sm"
                            style="background-image: url('{{ asset('storage/' . auth('admin')->user()->profile) }}')"></span>
                    @else
                        <span class="avatar avatar-sm bg-success text-white fw-bold">
                            {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}
                        </span>
                    @endif

                    <div class="d-none d-xl-block ps-2">
                        <div class="fw-bold">{{ auth('admin')->user()->name }}</div>
                        <div class="mt-1 small text-secondary">Administrator</div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="dropdown-header">
                        <div class="fw-bold">{{ auth('admin')->user()->name }}</div>
                        <div class="text-muted small">{{ auth('admin')->user()->email }}</div>
                    </div>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                        <i class="ti ti-settings me-2"></i> Pengaturan Profil
                    </a>

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="ti ti-logout me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

{{-- Navigasi Utama --}}
<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">

                    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-home icon"></i>
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.kampanye.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.kampanye.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-sparkles icon"></i>
                            </span>
                            <span class="nav-link-title">Kampanye</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('views.admin.donasi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('views.admin.donasi') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-heart icon"></i>
                            </span>
                            <span class="nav-link-title">Donasi</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.dampak.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dampak.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-seeding icon"></i>
                            </span>
                            <span class="nav-link-title">Dampak</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.dokumentasi.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dokumentasi.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-file-text icon"></i>
                            </span>
                            <span class="nav-link-title">Dokumentasi</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    const badge      = document.getElementById('notif-badge');
    const list       = document.getElementById('notif-list');
    const empty      = document.getElementById('notif-empty');
    const btnMarkAll = document.getElementById('btn-mark-all');
    const csrfToken  = document.querySelector('meta[name="csrf-token"]').content;

    function fetchCount() {
        fetch('{{ route("admin.notifications.api.count") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.count > 0) {
                badge.textContent = data.count > 99 ? '99+' : data.count;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        })
        .catch(() => {});
    }

    function fetchLatest() {
        fetch('{{ route("admin.notifications.api.latest") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            const items = data.notifications || [];
            list.querySelectorAll('.notif-item').forEach(el => el.remove());

            if (items.length === 0) {
                empty.style.display = '';
                return;
            }

            empty.style.display = 'none';

            items.forEach(n => {
                const el = document.createElement('div');
                el.className = 'notif-item' + (n.is_read ? '' : ' unread');
                el.innerHTML =
                    '<div style="flex-shrink:0; margin-top:2px;">' +
                        '<span class="avatar avatar-sm" style="background:#e8f4fd; color:#206bc4; font-size:14px;">' +
                            '<i class="ti ti-heart"></i>' +
                        '</span>' +
                    '</div>' +
                    '<div style="flex:1; overflow:hidden;">' +
                        '<div style="display:flex; justify-content:space-between; align-items:center;">' +
                            '<span style="font-size:13px; font-weight:600; color:#1d273b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:180px;">' + n.nama_donatur + '</span>' +
                            '<span style="font-size:11px; color:#9aa0ac; flex-shrink:0; margin-left:6px;">' + n.time + '</span>' +
                        '</div>' +
                        '<div style="font-size:12px; color:#6c757d; margin-top:2px;">' +
                            'Donasi masuk: <strong style="color:#2fb344;">' + n.jumlah_donasi + '</strong>' +
                        '</div>' +
                    '</div>' +
                    (n.is_read ? '' : '<div class="notif-dot"></div>');

                el.addEventListener('click', function () {
                    fetch(n.read_url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(() => {
                        el.classList.remove('unread');
                        const dot = el.querySelector('.notif-dot');
                        if (dot) dot.remove();
                        fetchCount();
                    }).catch(() => {});
                });

                list.appendChild(el);
            });
        })
        .catch(() => {});
    }

    btnMarkAll.addEventListener('click', function () {
        fetch('{{ route("admin.notifications.mark-all") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(r => {
            if (r.ok) {
                list.querySelectorAll('.notif-item').forEach(el => {
                    el.classList.remove('unread');
                    const dot = el.querySelector('.notif-dot');
                    if (dot) dot.remove();
                });
                badge.style.display = 'none';
            }
        }).catch(() => {});
    });

    document.getElementById('notif-toggle').addEventListener('click', fetchLatest);

    fetchCount();
    setInterval(fetchCount, 10000); //10 detik notifnya muncul sendiri
}());
</script>