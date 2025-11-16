@extends('layouts.user')

@section('title', 'Materi 3 - Kesalahan Umum dan Tips Copywriting')

@section('content')

<div class="container py-3">

    {{-- Back Button --}}
    <a href="{{ route('copywritting') }}" class="text-decoration-none mb-3 d-inline-flex align-items-center"
       style="font-size: 15px;">
        <i class="bi bi-arrow-left me-1"></i> 
    </a>

    {{-- Content Card --}}
    <div class="card shadow-sm p-4"
         style="max-width: 850px; margin:auto; border-radius:14px; border:1px solid #eee;">

        <h5 class="text-center mb-4" style="font-weight:600;">Materi 3</h5>

        <p>
            Dalam proses belajar copywriting, banyak pemula melakukan kesalahan yang mengurangi 
            efektivitas tulisan. Salah satu kesalahan umum adalah menulis kalimat yang terlalu 
            panjang dan bertele-tele sehingga pembaca cepat kehilangan fokus. Kalimat yang ringkas, 
            langsung ke inti, dan menekankan manfaat akan membuat copy lebih jelas dan mudah dipahami.        
        </p>

        <p>
            Kesalahan lain yang sering terjadi adalah pesan yang tidak jelas. Tanpa pesan utama 
            yang tegas, audiens akan bingung dengan tujuan copy. Penting untuk menentukan satu 
            pesan kunci dan memastikan setiap kalimat mendukung pesan tersebut sehingga pembaca 
            dapat langsung menangkap maksud tulisan.        
        </p>

        <p>
            Terlalu fokus pada penjualan juga menjadi kesalahan yang umum. Copy yang hanya berisi 
            ajakan “beli” atau “daftar” tanpa menonjolkan manfaat bagi pembaca biasanya kurang 
            menarik. Copy yang efektif menekankan bagaimana produk atau layanan dapat menyelesaikan 
            masalah audiens, sehingga mereka merasa mendapat nilai lebih sebelum melakukan tindakan.        
        </p>

        <p>
            Selain itu, banyak pemula tidak memahami kebutuhan audiens dengan baik. Copy yang 
            tidak relevan atau tidak sesuai dengan masalah yang mereka hadapi akan sulit menghasilkan 
            respons. Melakukan riset audiens, memahami pain point mereka, dan menggunakan bahasa yang 
            dekat dengan pembaca akan meningkatkan relevansi dan efektivitas copy.        
        </p>

        <p>
            Terakhir, tidak menggunakan ajakan bertindak (Call to Action/CTA) yang jelas 
            sering membuat pembaca bingung tentang langkah selanjutnya. Menambahkan CTA 
            seperti “Coba sekarang”, “Daftar gratis”, atau “Pelajari lebih lanjut” akan membantu 
            membimbing audiens untuk melakukan tindakan yang diinginkan.        
        </p>

    </div>


</div>

@endsection
