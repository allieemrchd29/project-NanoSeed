@extends('components.layout-admin')

@section('title', 'Profil Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profil Admin</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form Profil -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success text-white d-flex align-items-center">
                            <i class="ti ti-user-edit me-2"></i>
                            <h3 class="card-title mb-0">Ubah Profil Admin</h3>
                        </div>
                        
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="card-body p-4">
                                {{-- Bagian Upload Foto --}}
                                <div class="text-center mb-4">
                                    <div class="avatar avatar-xl mb-3" 
                                        id="preview-avatar" 
                                        style="background-image: url('{{ auth('admin')->user()->profile ? asset('storage/' . auth('admin')->user()->profile) : asset('img/default-avatar.png') }}')">
                                    </div>                                    
                                    <br>
                                    <label class="btn-center btn btn-outline-success btn-sm">
                                        Ganti Foto
                                        <input type="file" name="profile" class="d-none" accept="image/*" onchange="previewImage(event)">
                                    </label>
                                    <small class="d-block text-muted mt-2">Maksimal 2MB, format JPG/PNG</small>
                                </div>

                                <hr>

                                {{-- Input Nama --}}
                                <div class="mb-3">
                                    <label class="form-label required">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                                        <input type="text" name="name" class="form-control" value="{{ auth('admin')->user()->name }}" required>
                                    </div>
                                </div>

                                {{-- Input Password Baru --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ganti">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ulangi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password">
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Tombol --}}
                            <div class="card-footer d-flex justify-content-end bg-light">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary m-2">Kembali</a>
                                    <button type="submit" class="btn btn-success px-4 m-2">
                                    <i class="ti ti-device-floppy me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tombol Logout -->
                    <div class="text-end">
                        <button type="button" id="btn-logout-admin" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M9 12h12l-3 -3" />
                                <path d="M18 15l3 -3" />
                            </svg>
                            Logout
                        </button>

                        <form id="form-logout-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnLogout = document.getElementById('btn-logout-admin');
        
        if (btnLogout) {
            btnLogout.addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin ingin logout?',
                    text: "Anda harus login kembali untuk mengakses dashboard.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745', // Warna hijau biar senada sama tema NanoSeed lu
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-logout-admin').submit(); // Eksekusi logout asli
                    }
                });
            });
        }
    });
</script>
@endpush

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview-avatar');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.style.backgroundImage = `url('${e.target.result}')`;
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection