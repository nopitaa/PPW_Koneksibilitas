@extends('layouts.user')

@section('navbar') @endsection

@section('content')
<div class="container py-5" style="max-width:700px; margin:auto;">

    {{-- Kembali ke Step 1 --}}
    <a href="{{ route('lamar.step1', ['lowongan' => $lowongan->lowongan_id]) }}"
       class="text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Lamar Pekerjaan</h2>
        <p class="text-primary fw-semibold mb-1">Step 2</p>
        <p class="text-dark">Riwayat Pendidikan</p>
    </div>

    {{-- FORM STEP 2 --}}
<form method="POST"
      action="{{ route('lamar.step2.store', $lowongan->lowongan_id) }}">
    @csrf

        {{-- Pendidikan Terakhir --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Pendidikan Terakhir <span class="text-danger">*</span>
            </label>
        <select name="pendidikan_terakhir"
                id="pendidikan_terakhir"
                class="form-select"
                required>
            <option value="" disabled {{ old('pendidikan_terakhir') ? '' : 'selected' }}>
                Pilih Pendidikan
            </option>
            <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
            <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
            <option value="SMA/SMK" {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
            <option value="Diploma" {{ old('pendidikan_terakhir') == 'Diploma' ? 'selected' : '' }}>Diploma (D1/D2/D3)</option>
            <option value="Sarjana" {{ old('pendidikan_terakhir') == 'Sarjana' ? 'selected' : '' }}>Sarjana (S1)</option>
            <option value="Magister" {{ old('pendidikan_terakhir') == 'Magister' ? 'selected' : '' }}>Magister (S2)</option>
            <option value="Doktor" {{ old('pendidikan_terakhir') == 'Doktor' ? 'selected' : '' }}>Doktor (S3)</option>
        </select>
        </div>

        {{-- Institusi --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Nama Institusi Pendidikan Terakhir <span class="text-danger">*</span>
            </label>
            <input type="text"
                   name="institusi"
                   class="form-control"
                   value="{{ old('institusi') }}"
                   placeholder="Masukkan nama institusi"
                   required>
        </div>

        {{-- Jurusan (hanya tampil jika bukan SD / SMP) --}}
        <div class="mb-3" id="jurusan_wrapper"
             style="{{ in_array(old('pendidikan_terakhir'), ['SD','SMP']) ? 'display:none;' : '' }}">
            <label class="form-label fw-semibold" for="jurusan">
                Jurusan <span class="text-danger">*</span>
            </label>
            <input type="text"
                   id="jurusan"
                   name="jurusan"
                   class="form-control"
                   value="{{ old('jurusan') }}"
                   placeholder="Masukkan jurusan"
                   {{ !in_array(old('pendidikan_terakhir'), ['SD','SMP']) ? 'required' : '' }}>
            <small class="text-muted">Contoh: Teknik Informatika, Akuntansi, dsb.</small>
        </div>

        {{-- Tahun Mulai --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Tahun Mulai <span class="text-danger">*</span>
            </label>
            <input type="number"
                   name="tahun_mulai"
                   class="form-control"
                   value="{{ old('tahun_mulai') }}"
                   min="1970"
                   max="{{ now()->year }}"
                   placeholder="cth: 2019"
                   required>
        </div>

        {{-- Tahun Berakhir --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Tahun Berakhir <span class="text-danger">*</span>
            </label>
            <input type="number"
                   name="tahun_berakhir"
                   class="form-control"
                   value="{{ old('tahun_berakhir') }}"
                   min="1970"
                   max="{{ now()->year + 5 }}"
                   placeholder="cth: {{ now()->year }}"
                   required>
        </div>

        {{-- BUTTON --}}
        <div class="text-center">
            <button type="submit"
                    class="btn btn-primary px-5 py-2 rounded-pill fw-semibold">
                Lanjutkan
            </button>
        </div>

    </form>
</div>

@push('body')
<script>
(function () {
    // Daftar pendidikan yang TIDAK menampilkan field Jurusan
    const tanpaJurusan = ['SD', 'SMP'];

    const selectPendidikan = document.getElementById('pendidikan_terakhir');
    const jurusanWrapper   = document.getElementById('jurusan_wrapper');
    const jurusanInput     = document.getElementById('jurusan');

    if (!selectPendidikan || !jurusanWrapper || !jurusanInput) return;

    function toggleJurusan() {
        const val = selectPendidikan.value;
        if (tanpaJurusan.includes(val)) {
            // Sembunyikan & nonaktifkan field Jurusan
            jurusanWrapper.style.display  = 'none';
            jurusanInput.required         = false;
            jurusanInput.disabled         = true;
            jurusanInput.value            = '';   // kosongkan agar tidak terkirim
        } else {
            // Tampilkan & aktifkan kembali
            jurusanWrapper.style.display  = '';
            jurusanInput.required         = true;
            jurusanInput.disabled         = false;
        }
    }

    // Jalankan saat halaman dimuat (untuk old() value saat validasi gagal)
    toggleJurusan();

    // Jalankan setiap kali pilihan berubah
    selectPendidikan.addEventListener('change', toggleJurusan);
})();
</script>
@endpush

@endsection
