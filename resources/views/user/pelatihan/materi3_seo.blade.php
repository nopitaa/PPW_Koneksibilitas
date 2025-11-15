@extends('layouts.user')

@section('title', 'Materi 3 - Dasar SEO')

@section('content')

<div class="container py-4">

    <a href="{{ url()->previous() }}" class="text-decoration-none mb-3 d-inline-block">
        <i class="bi bi-arrow-left"></i>
    </a>

    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold text-center mb-3">Materi 3</h4>

        <p>
            Beberapa aspek penting yang perlu diperhatikan dari on-page SEO yaitu seperti penempatan keyword,
            struktur konten, heading, alt text, internal link, dan lain sebagainya.
        </p>

        <p>
            Sedangkan off-page SEO berhubungan dengan backlink yang didapat dari website lain.
        </p>

        <p>
            Dalam proses teknikal SEO yang berhubungan dengan sistem teknis suatu website, seperti struktur website,
            sitemap, dan kecepatan loading website.
        </p>

        <p>
            Kamu juga perlu memahami tentang crawling, indexing, dan ranking.
            Proses crawling yaitu ketika robot Google menelusuri website kamu.
        </p>

        <p>
            Proses indexing yaitu ketika Google menyimpan kontenmu ke dalam database mereka.
        </p>

        <p>
            Dan ranking adalah proses Google menampilkan konten-konten yang dianggap paling relevan.
            Hasil akan ditampilkan berdasarkan halaman yang paling relevan.
        </p>
    </div>

</div>

@endsection
