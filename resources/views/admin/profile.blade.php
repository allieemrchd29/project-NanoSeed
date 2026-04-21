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
                                    <div class="avatar avatar-xl mb-3" style="background-image: url('{{ auth('admin')->user()->profile ? asset('storage/' . auth('admin')->user()->profile) : asset('img/default-avatar.png') }}')"></div>
                                    <br>
                                    <label class="btn-center btn btn-outline-success btn-sm">
                                        Ganti Foto
                                        <input type="file" name="profile" class="d-none">
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
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>                                <button type="submit" class="btn btn-success px-4">
                                    <i class="ti ti-device-floppy me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tombol Logout -->
                    <div class="text-end">
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                <i class="fas fa-sign-out-alt me-1"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.borderColor = '#0d6efd';
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection