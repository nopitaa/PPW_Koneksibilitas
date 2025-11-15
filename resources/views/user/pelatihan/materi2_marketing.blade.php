@extends('layouts.user')

@section('title', 'Materi 2 - Social media marketing')

@section('content')
<div class="container py-3">

    {{-- Tombol kembali --}}
    <a href="{{ url()->previous() }}" class="text-decoration-none mb-3 d-inline-flex align-items-center fs-6">
        <i class="bi bi-arrow-left me-1"></i> 
    </a>

    {{-- Card konten --}}
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 850px; border-radius:14px; border:1px solid #eee;">
        <h5 class="text-center mb-4 fw-semibold">Materi 2</h5>

        <p>
            Belajarlagi menjelaskan bahwa strategi SMM yang efektif dimulai dari memahami siapa target audiensmu. 
            Tanpa mengetahui siapa yang dituju, konten yang dibuat bisa salah sasaran dan tidak menghasilkan interaksi. 
            Oleh karena itu, penting untuk menentukan segmentasi berdasarkan usia, minat, kebutuhan, serta platform favorit mereka.
        </p>

        <p>
            Setelah memahami audiens, langkah berikutnya adalah memilih platform yang sesuai. 
            Setiap media sosial memiliki karakteristik berbeda. Instagram cocok untuk visual branding, 
            TikTok untuk konten kreatif dan cepat viral, sedangkan Facebook efektif untuk komunitas dan informasi panjang. 
            Pemilihan platform yang tepat membantu konten lebih mudah menjangkau pengguna yang relevan.
        </p>

        <p>
            Pembuatan konten menjadi inti dari strategi SMM. Konten harus informatif, menarik, dan sesuai kebutuhan audiens. 
            Bentuknya bisa foto, video pendek, carousel edukatif, konten storytelling, atau konten hiburan. 
            Konsistensi posting juga sangat penting. Dengan kalender konten, kamu bisa merencanakan tema setiap minggu 
            agar brand tetap aktif dan relevan.
        </p>

        <p>
            Terakhir, analisis performa melalui insight sangat membantu memahami apa yang disukai audiens. 
            Data seperti reach, impresi, dan engagement rate dapat menjadi dasar evaluasi dan perbaikan strategi berikutnya.
        </p>
    </div>
</div>
@endsection
