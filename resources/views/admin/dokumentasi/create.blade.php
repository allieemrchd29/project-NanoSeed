@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl py-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="page-title">Tambah Dokumentasi</h2>
                <a href="{{ route('admin.dokumentasi.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Kampanye</label>
                            <select name="id_kampanye" class="form-select @error('id_kampanye') is-invalid @enderror">
                                <option value="">-- Pilih Kampanye --</option>
                                @foreach ($kampanye as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('id_kampanye') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kampanye }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kampanye')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                                class="form-control @error('keterangan') is-invalid @enderror">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Dokumentasi</label>
                            <input type="datetime-local" name="tanggal_dokumentasi" value="{{ old('tanggal_dokumentasi') }}"
                                class="form-control @error('tanggal_dokumentasi') is-invalid @enderror">
                            @error('tanggal_dokumentasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Dokumentasi</label>
                            <input type="file" name="fotos[]" id="fotos" multiple accept="image/*">
                            @error('fotos.*')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="ti ti-check me-1"></i> Simpan
                            </button>
                            <a href="{{ route('admin.dokumentasi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginFileValidateType
            );

            FilePond.create(document.getElementById('fotos'), {
                allowMultiple: true,
                allowReorder: true,
                labelIdle: 'Drop foto di sini atau <span class="filepond--label-action">Browse</span>',
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/webp'],
                storeAsFile: true,
            });
        });
    </script>
@endsection
