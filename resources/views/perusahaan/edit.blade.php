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
                        <form id="form-edit-lowongan" action="" method="POST">
                            {{-- @csrf --}}
                            {{-- @method('PUT') --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-15">

                                        {{-- Posisi Lowongan --}}
                                        <div class="form-group">
                                            <label for="posisi" class="form-control-label">Posisi Lowongan</label>
                                            <input class="form-control" type="text" name="posisi" id="posisi"
                                                value="Backend Engineer" required>
                                        </div>
                                    </div>

                                    {{-- Persyaratan --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="persyaratan" class="form-control-label">Persyaratan Lowongan</label>
                                            <textarea class="form-control" name="persyaratan" id="persyaratan" rows="4" required>- Mahir PHP dan Laravel
                                                - Menguasai REST API
                                                - Minimal pengalaman 1 tahun</textarea>
                                        </div>
                                    </div>

                                    {{-- Kategori --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kategori_pekerjaan" class="form-control-label">Kategori
                                                Pekerjaan</label>
                                            <input class="form-control" type="text" name="kategori_pekerjaan"
                                                id="kategori_pekerjaan" value="Full Time" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endsection
