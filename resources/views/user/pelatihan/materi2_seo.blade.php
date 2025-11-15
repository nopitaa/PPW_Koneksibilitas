@extends('layouts.user')

@section('title', 'Materi 2 - Dasar SEO')

@section('content')

<div class="container py-4">

    <a href="{{ url()->previous() }}" class="text-decoration-none mb-3 d-inline-block">
        <i class="bi bi-arrow-left"></i> 
    </a>

    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold text-center mb-3">Materi 2</h4>

        <p>
            Banyak metode yang bisa kamu gunakan untuk belajar. Apalagi di zaman serba digital,
            kamu bisa memanfaatkan banyak referensi yang ada di internet.
        </p>

        <p>
            Misalnya saja seperti video, podcast, blog, artikel, webinar, dan e-book.
            Dari beberapa metode pembelajaran SEO, berikut diantaranya:
        </p>

        <ul>
            <li>1. YouTube</li>
            <li>2. Artikel</li>
            <li>3. Backlink</li>
            <li>4. Skillshare</li>
        </ul>

        <p>
            Kamu juga bisa belajar SEO melalui video-video yang mereka buat untuk meningkatkan
            skill di dunia SEO. Misalnya di LinkedIn, Instagram, dan YouTube.
        </p>

        <p>
            Semua platform itu bisa menjadi tempat kamu mempelajari SEO secara lebih mendalam.
            Kamu juga bisa bertanya langsung kepada ahlinya. Yuk, mulai belajar SEO secara profesional
            agar bisa membantu meningkatkan karier kamu!
        </p>
    </div>

</div>

@endsection
