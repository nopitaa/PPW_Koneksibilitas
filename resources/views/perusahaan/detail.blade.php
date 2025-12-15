@extends('layouts_perusahaan.master')

@section('content')

    <!-- HEADER -->
    <div class="card shadow-lg mx-4 card-profile-top mt-4">
        <div class="card-body p-3">
            <div class="row gx-5 align-items-center">
                <div class="col-auto">
                    <h5 class="mb-0 text-black">Detail Lowongan Pekerjaan</h5>
                </div>
                <div class="col text-end">
                    <a href="{{ route('informasi-lowongan') }}"
                        class="btn btn-light fw-semibold text-primary border"
                        style="border-color:#0b5ed7">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container-fluid py-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <!-- POSISI -->
                <div class="row mb-3">
                    <div class="col-md-4 fw-semibold">Posisi Lowongan</div>
                    <div class="col-md-8">{{ $lowongan->posisi }}</div>
                </div>

                <!-- KATEGORI -->
                <div class="row mb-3">
                    <div class="col-md-4 fw-semibold">Kategori Pekerjaan</div>
                    <div class="col-md-8">{{ $lowongan->kategori_pekerjaan }}</div>
                </div>

                <!-- PERSYARATAN -->
                <div class="row mb-3">
                    <div class="col-md-4 fw-semibold">Persyaratan</div>
                    <div class="col-md-8">
                        {!! ($lowongan->persyaratan) !!}
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
