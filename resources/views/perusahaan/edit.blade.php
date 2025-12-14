    @extends('layouts_perusahaan.master')

    @section('page-title', 'Edit Data Lowongan')

    @section('content')
        <div class="card shadow-lg mx-4 card-profile-top mt-4">
            <div class="card-body p-3">
                <div class="row gx-5">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                Edit Data Lowongan Pekerjaan
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD FORM --}}
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12 mr-3 ml-3">
                    <div class="card">

                        {{-- BUTTON SIMPAN --}}
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <button type="submit" form="form-edit-lowongan"
                                    class="btn btn-success btn-sm ms-auto">Perbarui Lowongan</button>
                            </div>
                        </div>

                        {{-- FORM EDIT LOWONGAN --}}
                        <form id="form-edit-lowongan" action="{{ route('update-lowongan', $lowongan->lowongan_id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">

                                    {{-- Posisi Lowongan --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="posisi" class="form-control-label">Posisi Lowongan</label>
                                            <input class="form-control" type="text" name="posisi" id="posisi"
                                                value="{{ $lowongan->posisi }}" required>
                                        </div>
                                    </div>

                                    {{-- Kategori --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kategori_pekerjaan" class="form-control-label">Kategori
                                                Pekerjaan</label>
                                            <input class="form-control" type="text" name="kategori_pekerjaan"
                                                id="kategori_pekerjaan" value="{{ $lowongan->kategori_pekerjaan }}"
                                                required>
                                        </div>
                                    </div>

                                    {{-- Persyaratan --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="persyaratan" class="form-control-label">Persyaratan Lowongan</label>

                                            <textarea class="form-control" name="persyaratan" id="persyaratan" rows="5" required>
                                            {{ $lowongan->persyaratan }}
                                        </textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('informasi-lowongan') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create(document.querySelector('#persyaratan'))
                .catch(error => {
                    console.error(error);
                });
        </script>

    @endsection
