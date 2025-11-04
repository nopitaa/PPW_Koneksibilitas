@extends('layouts_perusahaan.master')

@section('page-title', 'Tambah Data Lowongan Perusahaan ')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-top mt-4">
      <div class="card-body p-3">
        <div class="row gx-5">
         
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                Form Tambah Lowongan Pekerjaan
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>

  {{-- card --}}
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12 mr-3 ml-3">
        <div class="card">

          {{-- button atas --}}
          <div class="card-header pb-0">
            {{-- BUTTON SEND DATA --}}
            {{-- button juga pake tipe yang post ya, buat ngirim data. --}}
            <div class="d-flex align-items-center">
              <button type="submit"  form="form-lowongan-perusahaan"  class="btn btn-success btn-sm ms-auto">Simpan Lowongan</button>
            </div>
          </div>

          {{--CARD FORM  --}}
          {{-- <form id="form-lowongan-perusahaan" action="{{ route('mahasiswa.store') }}" method="POST"> --}}
          <form id="form-lowongan-perusahaan" action="" method="POST">
            {{-- @csrf --}}
            <div class="card-body">
              <div class="row">
                <div class="col-md-15">

                  {{-- form judul --}}
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Posisi Lowongan</label>
                    <input class="form-control" type="text" name = "posisi" placeholder="Masukkan Posisi Lowongan" id="posisi" required value="{{ old('posisi') }}">

                      @error('posisi')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                      @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Persyaratan Lowongan</label>
                    {{-- nana : pastikan id sama nameharus sama kaya ditabel ya klo engga nnti dia ga kekirim ke db --}}
                    <input class="form-control" type="number" name = "persyaratan" placeholder="Masukkan Persyaratan Lowongan" id = "persyaratan" required value="{{ old('persyaratan') }}">
                    @error('persyaratan')
                      <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kategori Pekerjaan</label>
                    <input type="text" name="kategori_pekerjaan" class="form-control" placeholder="Masukkan Kategori Pekerjaan(Fulltime/Remote)" required value="{{ old('kategori_pekerjaan') }}">
                    @error('kategori_pekerjaan')
                      <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- <script>
    // get form by id 'form-mahasiswa' eventnya submit
    document.getElementById('form-mahasiswa').addEventListener('submit', async function(e) {
      e.preventDefault(); // Supaya form tidak reload page

      const formData = new FormData(this);

      try {
        // mengirim data melalui api "api/mahasiswa" dengan method post
        const response = await fetch('/api/mahasiswa', { 
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' 
          },
          body: formData
        });

        // Ambil respon dari server dan ubah ke bentuk JSON supaya bisa dibaca/dipakai.
        const result = await response.json();

        // Notification
        if (response.ok) {
          alert('Data mahasiswa berhasil ditambahkan!');
          window.location.href = '/datamahasiswa'; 
        } else {
          alert('Gagal menambahkan data: ' + (result.message || 'Unknown error'));
        }
        
      } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan jaringan');
      }
    });
  </script> --}}
@endsection