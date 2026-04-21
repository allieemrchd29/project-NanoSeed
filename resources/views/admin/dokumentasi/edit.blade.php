@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl py-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="page-title">Edit Dokumentasi</h2>
                <a href="{{ route('admin.dokumentasi.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    {{-- Form untuk menghapus foto --}}
                    @foreach ($dokumentasi->fotos as $foto)
                        <form id="delete-foto-{{ $foto->id }}"
                            action="{{ route('admin.dokumentasi.foto.destroy', $foto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach

                    {{-- Form utama edit --}}
                    <form id="form-edit-dokumentasi"
                        action="{{ route('admin.dokumentasi.update', $dokumentasi->id_dokumentasi) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Kampanye</label>
                            <select name="id_kampanye" class="form-select @error('id_kampanye') is-invalid @enderror">
                                <option value="">-- Pilih Kampanye --</option>
                                @foreach ($kampanye as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('id_kampanye', $dokumentasi->id_kampanye) == $item->id ? 'selected' : '' }}>
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
                            <input type="text" name="keterangan"
                                value="{{ old('keterangan', $dokumentasi->keterangan) }}"
                                class="form-control @error('keterangan') is-invalid @enderror">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Dokumentasi</label>
                            <input type="datetime-local" name="tanggal_dokumentasi"
                                value="{{ old('tanggal_dokumentasi', \Carbon\Carbon::parse($dokumentasi->tanggal_dokumentasi)->format('Y-m-d\TH:i')) }}"
                                class="form-control @error('tanggal_dokumentasi') is-invalid @enderror">
                            @error('tanggal_dokumentasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Foto yang sudah ada --}}
                        @if ($dokumentasi->fotos->count() > 0)
                            <div class="mb-3">
                                <label class="form-label">Foto Saat Ini</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($dokumentasi->fotos as $foto)
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $foto->foto) }}" class="rounded"
                                                style="width:100px;height:100px;object-fit:cover;">
                                            <button type="button"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                style="padding:2px 6px;" onclick="confirmDeleteFoto({{ $foto->id }})">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Tambah Foto Baru</label>
                            <input type="file" name="fotos[]" id="fotos" multiple accept="image/*">
                            @error('fotos.*')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-success" onclick="submitForm()">
                                <i class="ti ti-check me-1"></i> Update
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

        function confirmDeleteFoto(id) {
            Swal.fire({
                title: 'Hapus Foto?',
                text: 'Apakah kamu yakin ingin menghapus foto ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-foto-' + id).submit();
                }
            });
        }

        function submitForm() {
            document.getElementById('form-edit-dokumentasi').submit();
        }
    </script>
@endsection
