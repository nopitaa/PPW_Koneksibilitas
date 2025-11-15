@extends('layouts.user')

@section('title', 'Materi 1 - Dasar SEO')

@section('content')

<div class="container py-4">

    <a href="{{ url()->previous() }}" class="text-decoration-none mb-3 d-inline-block">
        <i class="bi bi-arrow-left"></i> 
    </a>

    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold text-center mb-3">Materi 1</h4>

        <p>
            Pengertian SEO menurut para ahli, Neil Patel, adalah sebuah proses atau metode
            yang digunakan untuk membantu sebuah website untuk berada di peringkat atas halaman pertama Google.
        </p>

        <p>
            Sedangkan menurut MOZ, SEO adalah metode yang digunakan untuk meningkatkan kuantitas
            dan kualitas pengunjung website dan membuat website tampil secara organik.
        </p>

        <p>
            Dari pengertian para ahli di atas, penggunaan SEO merupakan sebuah cara atau metode
            untuk meningkatkan jumlah pengunjung suatu website (trafiknya) yang didapat secara organik
            melalui mesin pencarian seperti Google.
        </p>

        <p>
            Maka dari itu, SEO sendiri bisa dilakukan dengan menggunakan keyword atau kata kunci yang
            diketikkan oleh pengguna di Google.
        </p>

        <p>
            Misalnya, kamu ingin mengetahui tentang SEO. Mungkin kamu ingin mengetikkan
            “Apa itu SEO?”. Semakin tepat penggunaan keyword SEO – kata kunci tadi berbeda,
            namun memiliki kata yang sama.
        </p>

        <p>
            Dalam materi ini, kamu perlu memahami konten dengan mengetahui letak-letak kunci ingat,
            mengerti apa definisi dari sebuah konten, memahami konten yang relevance serta
            langkah mengembangkan peran-peran pada pembuatan konten yang kiranya bisa meningkatkan peluang
            kontenmu muncul di halaman pertama Google.
        </p>
    </div>

</div>

@endsection
