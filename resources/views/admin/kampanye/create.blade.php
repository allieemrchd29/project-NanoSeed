@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl py-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="page-title">Tambah Kampanye</h2>
                <a href="{{ route('admin.kampanye.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.kampanye.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Kampanye</label>
                            <input type="text" name="nama_kampanye" value="{{ old('nama_kampanye') }}"
                                class="form-control @error('nama_kampanye') is-invalid @enderror">
                            @error('nama_kampanye')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Kampanye</label>
                            <select name="status_kampanye" class="form-select">
                                @foreach (['aktif', 'nonaktif', 'selesai'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status_kampanye') === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                                    class="form-control @error('tanggal_selesai') is-invalid @enderror">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Kampanye</label>
                            <input type="file" name="gambar_kampanye" accept="image/*"
                                class="form-control @error('gambar_kampanye') is-invalid @enderror">
                            <div class="form-text">Format: jpg, jpeg, png, webp. Maks 2MB.</div>
                            @error('gambar_kampanye')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="ti ti-check me-1"></i> Simpan
                            </button>
                            <a href="{{ route('admin.kampanye.index') }}" class="btn btn-secondary">Batal</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
