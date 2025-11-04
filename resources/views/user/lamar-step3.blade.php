@extends('layouts.user')

@section('navbar') @endsection

@section('content')
<div class="container py-5" style="max-width:760px; margin:auto;">
    <a href="{{ route('lamar.step2') }}" class="text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Lamar Pekerjaan</h2>
        <p class="text-primary fw-semibold mb-1">Step 3</p>
        <p class="text-dark">Informasi Lain</p>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <div class="fw-semibold mb-1">Periksa kembali input kamu:</div>
        <ul class="mb-0">
          @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('lamar.submit') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Jenis Disabilitas --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Jenis Disabilitas <span class="text-danger">*</span></label>
            <div class="d-flex gap-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_disabilitas" id="jd1" value="tuna_wicara">
                    <label class="form-check-label" for="jd1">Tuna Wicara</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_disabilitas" id="jd2" value="tuna_rungu" checked>
                    <label class="form-check-label" for="jd2">Tuna Rungu</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_disabilitas" id="jd3" value="lainnya">
                    <label class="form-check-label" for="jd3">Lainnya</label>
                </div>
            </div>
        </div>

        {{-- Alat Bantu --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Alat Bantu yang Digunakan</label>
            <input type="text" class="form-control" name="alat_bantu" placeholder="Contoh: Alat bantu dengar">
        </div>

        {{-- CV --}}
        <div class="mb-3">
            <label class="form-label fw-semibold d-block">CV</label>
            <input type="file" class="form-control" name="cv" accept=".pdf,.doc,.docx">
            <small class="text-muted">Format: PDF/DOC/DOCX · Maks 2MB</small>
            <div id="cv-info" class="file-chip mt-2 d-none"></div>
        </div>

        {{-- Portofolio --}}
        <div class="mb-3">
            <label class="form-label fw-semibold d-block">Portofolio</label>
            <input type="file" class="form-control" name="portofolio" accept=".pdf,.doc,.docx,.zip">
            <small class="text-muted">Format: PDF/DOC/DOCX/ZIP · Maks 5MB</small>
            <div id="porto-info" class="file-chip mt-2 d-none"></div>
        </div>

        {{-- Dokumen Tambahan (dropzone sederhana) --}}
        <div class="mb-4">
            <label class="form-label fw-semibold d-block">Dokumen Tambahan</label>

            <div id="dropzone" class="dropzone mb-2"
                 onclick="document.getElementById('dokumen_tambahan').click()">
                <div class="text-center text-muted">
                    <i class="bi bi-cloud-upload fs-3 d-block mb-1"></i>
                    <div>Upload file</div>
                </div>
            </div>

            <input id="dokumen_tambahan" type="file" name="dokumen_tambahan[]"
                   class="d-none" multiple
                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip">

            <div id="extra-list"></div>
            <small class="text-muted">Bisa pilih banyak file · PDF/DOC/DOCX/JPG/PNG/ZIP · Maks 5MB per file</small>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill fw-semibold">
                Kirim Lamaran
            </button>
        </div>
    </form>
</div>

{{-- ==== Styling ringan agar mirip screenshot ==== --}}
<style>
.dropzone{
    border:2px dashed #6aa6ff; border-radius:14px; padding:28px; cursor:pointer;
    background:#f8fbff;
}
.dropzone.dragover{ background:#eef6ff; }
.file-chip{
    display:flex; align-items:center; gap:10px; background:#f4f6f8; border-radius:10px;
    padding:10px 12px; font-size:.95rem;
}
.file-chip i{ opacity:.75; }
</style>

{{-- ==== Script preview filename dan drag-drop ==== --}}
<script>
(function(){
  const dz = document.getElementById('dropzone');
  const extra = document.getElementById('dokumen_tambahan');
  const extraList = document.getElementById('extra-list');

  const chip = (name, sizeKb) =>
    `<div class="file-chip mb-2"><i class="bi bi-file-earmark-text"></i><div><div>${name}</div><small class="text-muted">${sizeKb} KB</small></div></div>`;

  const bindSingle = (input, infoId) => {
    const el = document.querySelector(input);
    const info = document.getElementById(infoId);
    el.addEventListener('change', () => {
      if (el.files && el.files[0]) {
        const f = el.files[0];
        info.classList.remove('d-none');
        info.innerHTML = `<i class="bi bi-file-earmark-arrow-down"></i>
                          <div><div>${f.name}</div><small class="text-muted">${Math.round(f.size/1024)} KB</small></div>`;
      } else { info.classList.add('d-none'); info.innerHTML = ''; }
    });
  };

  bindSingle('input[name="cv"]','cv-info');
  bindSingle('input[name="portofolio"]','porto-info');

  extra.addEventListener('change', () => {
    extraList.innerHTML = '';
    Array.from(extra.files).forEach(f => {
      extraList.insertAdjacentHTML('beforeend', chip(f.name, Math.round(f.size/1024)));
    });
  });

  // drag & drop
  ['dragenter','dragover'].forEach(ev => dz.addEventListener(ev, e => { e.preventDefault(); e.stopPropagation(); dz.classList.add('dragover'); }));
  ['dragleave','drop'].forEach(ev => dz.addEventListener(ev, e => { e.preventDefault(); e.stopPropagation(); dz.classList.remove('dragover'); }));
  dz.addEventListener('drop', e => {
    if (!e.dataTransfer.files.length) return;
    extra.files = e.dataTransfer.files;
    const event = new Event('change'); extra.dispatchEvent(event);
  });
})();
</script>
@endsection
