@extends('components.layout-admin')

@section('content')

@include('components.navbar-admin')
  
{{-- Page Wrapper (Main Content) --}}
<div class="page-wrapper">

  {{-- Page Header --}}
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">Dashboard</h2>
          <div class="text-muted mt-1">
             Selamat datang kembali, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
          </div>          
        </div>
      </div>
    </div>
  </div>

  {{-- Page Body --}}
  <div class="page-body">
    <div class="container-xl">

      {{-- Session Success Message --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert">
          <div class="d-flex">
            <i class="ti ti-check icon me-2"></i>
            <div>{{ session('success') }}</div>
          </div>
          <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
      @endif

      {{-- Stats Cards --}}
      <div class="row row-deck row-cards mb-4">
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-primary text-white avatar"><i class="ti ti-user"></i></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">1 Admin</div>
                  <div class="text-muted">Status Aktif</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-success text-white avatar"><i class="ti ti-leaf"></i></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">Nanoseed</div>
                  <div class="text-muted">v1.0.0</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-warning text-white avatar"><i class="ti ti-calendar"></i></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">{{ now()->format('d M Y') }}</div>
                  <div class="text-muted">{{ now()->format('H:i') }} WIB</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-info text-white avatar"><i class="ti ti-world"></i></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">Sistem Online</div>
                  <div class="text-muted">Running Well</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Welcome Card --}}
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Grafik Donasi Masuk</h3>
            <div class="d-flex align-items-center">
                <span class="text-muted me-3">Total Donatur: <strong>{{ $totalDonatur ?? 0 }} Orang</strong></span>
                
                <div class="dropdown">
                    <form action="{{ route('admin.dashboard') }}" method="GET" id="formFilter">
                        <select name="range" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="7_days" {{ request('range') == '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                            <option value="30_days" {{ request('range') == '30_days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                            <option value="this_month" {{ request('range') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="chart-donasi-keren" style="height: 300px;"></div>
        </div>
    </div>
    </div>
  </div>

  {{-- Footer --}}
  <footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-lg-auto ms-lg-auto">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item">
              &copy; {{ date('Y') }} <strong>Nanoseed Admin</strong>.
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
    series: [{
        name: 'Donasi Masuk',
        data: @json($totals)
    }],
    chart: {
        type: 'area',
        height: 350,
        zoom: { enabled: false },
        toolbar: { show: false }
    },
    colors: ['#2fb344'], 
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.2,
            stops: [0, 90, 100]
        }
    },
    dataLabels: { enabled: false },
    stroke: {
        curve: 'straight', 
        width: 3
    },
    xaxis: {
        categories: @json($labels),
        type: 'datetime',
        labels: { format: 'dd MMM' }
    },
    yaxis: {
        labels: {
            formatter: function (val) {
                return "Rp " + val.toLocaleString('id-ID');
            }
        }
    },
    markers: {
        size: 5, 
        colors: ['#2fb344'],
        strokeColors: '#fff',
        strokeWidth: 2,
    }
};

        var chart = new ApexCharts(document.querySelector("#chart-donasi-keren"), options);
        chart.render();
    });
</script>
@endsection