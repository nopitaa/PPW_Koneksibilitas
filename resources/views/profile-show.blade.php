@extends('layouts.user')
@section('title','Profile — KONEKSIBILITAS')

@section('content')
  {{-- Header: avatar + nama --}}
  <div class="d-flex flex-column align-items-center text-center gap-3 mt-2 mb-4">
    <img class="avatar shadow-sm" src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}">
    <div>
      <h4 class="mb-1">{{ $user['name'] }}</h4>
      <div class="text-secondary">{{ $user['subtitle'] }}</div>
    </div>
  </div>

  {{-- Tentang Saya --}}
  <section class="mb-4">
    <h6 class="mb-2">Tentang Saya</h6>
    <div class="card-soft p-3">
      @if (session('success'))
        <div class="alert alert-success py-2 mb-3">{{ session('success') }}</div>
      @endif

      <form action="{{ route('profile.updateAbout') }}" method="POST" class="d-grid gap-3">
        @csrf
        <textarea name="about" class="form-control" rows="4" required>{{ old('about', $user['about']) }}</textarea>
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </section>

  {{-- Keterampilan --}}
  <section class="mb-4">
    <h6 class="mb-3">Keterampilan</h6>
    <div class="d-flex flex-wrap gap-2">
      @foreach ($user['skills'] as $skill)
        <span class="btn btn-primary pill">{{ $skill }}</span>
      @endforeach
    </div>
  </section>

  {{-- Dokumen --}}
  <section class="mb-5">
    <h6 class="mb-3">Dokumen</h6>

    @foreach ($user['documents'] as $idx => $doc)
      <div class="doc-row d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
          <span class="btn btn-light rounded-circle p-0 d-inline-grid place-items-center" style="width:42px;height:42px;">
            <i class="bi bi-file-earmark-text fs-5"></i>
          </span>
          <div>
            <div class="fw-semibold">{{ $doc['title'] }}</div>
            <div class="text-secondary small">{{ $doc['desc'] }}</div>
          </div>
        </div>
        <a href="{{ $doc['url'] }}" class="text-decoration-none">
          <i class="bi bi-chevron-right"></i>
        </a>
      </div>
    @endforeach
  </section>
@endsection
