@extends('layouts.user')

@section('title', 'Materi 3 - Social media marketing')

@section('content')
<div class="container py-3">

    {{-- Tombol kembali --}}
    <a href="{{ url()->previous() }}" class="text-decoration-none mb-3 d-inline-flex align-items-center fs-6">
        <i class="bi bi-arrow-left me-1"></i> 
    </a>

    {{-- Card konten --}}
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 850px; border-radius:14px; border:1px solid #eee;">
        <h5 class="text-center mb-4 fw-semibold">Materi 3</h5>

        <p>
            Dalam proses belajar SMM, banyak pemula melakukan kesalahan yang sebenarnya dapat dihindari. 
            Salah satu kesalahan terbesar adalah tidak memiliki strategi yang jelas. Akibatnya, konten 
            diunggah tanpa arah, tidak konsisten, dan sulit membangun audiens. Kesalahan lainnya adalah 
            terlalu fokus pada penjualan sehingga membuat pengguna merasa jenuh dan menjauh.
        </p>

        <p>
            Belajarlagi juga menyoroti kesalahan seperti menyalin konten dari kompetitor tanpa menyesuaikan 
            dengan karakter brand sendiri, tidak memahami algoritma platform, serta mengabaikan data insight 
            yang sebenarnya sangat penting untuk perbaikan konten. Kurangnya interaksi juga menjadi masalah umum, 
            karena media sosial pada dasarnya tempat untuk membangun hubungan dua arah.
        </p>

        <p>
            Untuk mengatasinya, beberapa tips dapat diterapkan. Pertama, susun strategi berdasarkan tujuan—
            apakah untuk awareness, engagement, atau penjualan. Kedua, buat konten yang memberi nilai, 
            bukan hanya promosi. Ketiga, gunakan berbagai fitur seperti Reels, Stories, atau Live 
            untuk meningkatkan jangkauan. Keempat, jaga konsistensi posting agar brand tetap terlihat aktif. 
            Dan yang terpenting, selalu evaluasi hasil setiap minggu atau bulan untuk mengetahui 
            konten mana yang paling efektif.
        </p>

        <p>
            Dengan menerapkan tips ini, kampanye SMM dapat berkembang lebih cepat dan memberikan dampak 
            yang lebih besar bagi brand.
        </p>
    </div>
</div>
@endsection
