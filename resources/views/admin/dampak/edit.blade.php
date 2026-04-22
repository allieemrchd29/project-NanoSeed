@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

         <style>
        .icon-option {
        overflow: visible !important;
        transition: all 0.2s ease-in-out;
        display: flex !important;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 80px; 
    }

    .icon-option i {
        height: 30px; 
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 8px;
    }
    </style>
    
<div class="container-fluid px-4">
    <h4 class="fw-bold mb-3">Edit Dampak</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.dampak.update', $dampak) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Dampak</label>
                    <input type="text" name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $dampak->judul) }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
    <label class="form-label fw-semibold">Icon Dampak</label>
    <div class="icon-picker-grid">
        @php
        $icons = [
            ['class' => 'fa-tree',          'label' => 'Pohon'],
            ['class' => 'fa-wind',          'label' => 'Udara / CO₂'],
            ['class' => 'fa-tint',          'label' => 'Air'],
            ['class' => 'fa-paw',           'label' => 'Satwa Liar'],
            ['class' => 'fa-sun',           'label' => 'Energi'],
            ['class' => 'fa-leaf',          'label' => 'Daun / Alam'],
            ['class' => 'fa-seedling',      'label' => 'Bibit'],
            ['class' => 'fa-globe-asia',    'label' => 'Bumi'],
            ['class' => 'fa-cloud-sun-rain','label' => 'Iklim'],
            ['class' => 'fa-mountain',      'label' => 'Lahan'],
            ['class' => 'fa-users',         'label' => 'Komunitas'],
            ['class' => 'fa-recycle',       'label' => 'Daur Ulang'],
        ];
        $selected = old('icon', $dampak->icon ?? 'fa-leaf');
        @endphp

        <div class="row g-2">
            @foreach($icons as $icon)
            <div class="col-3 col-md-2">
                <input type="radio" name="icon" id="icon_{{ $icon['class'] }}"
                       value="{{ $icon['class'] }}"
                       class="d-none icon-radio"
                       {{ $selected === $icon['class'] ? 'checked' : '' }}>
                <label for="icon_{{ $icon['class'] }}"
                       class="icon-option d-flex flex-column align-items-center
                              justify-content-center p-2 rounded border text-center
                              {{ $selected === $icon['class'] ? 'border-success bg-success text-white' : 'border-light bg-light text-muted' }}"
                       style="cursor:pointer; transition: all .2s;">
                    <i class="fas {{ $icon['class'] }} fa-lg mb-1"></i>
                    <small style="font-size:10px;">{{ $icon['label'] }}</small>
                </label>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.icon-radio').forEach(radio => {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.icon-option').forEach(label => {
                label.classList.remove('border-success', 'bg-success', 'text-white');
                label.classList.add('border-light', 'bg-light', 'text-muted');
            });
            const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
            selectedLabel.classList.add('border-success', 'bg-success', 'text-white');
            selectedLabel.classList.remove('border-light', 'bg-light', 'text-muted');
        });
    });
</script>
@endpush

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="5"
                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $dampak->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                    <a href="{{ route('admin.dampak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection