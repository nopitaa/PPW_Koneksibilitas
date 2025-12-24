@extends('layouts_perusahaan.master')

@section('page-title', 'Registrasi Perusahaan')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="mb-4">Registrasi Perusahaan</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register-perusahaan.process') }}">
                @csrf

                <div class="mb-3">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Nomor NPWP</label>
                    <input type="text" name="nomor_npwp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">
                    Daftar & Masuk
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
