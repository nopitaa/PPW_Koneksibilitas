@extends('layouts.user')

@section('title', 'Materi 2 Dasa- Dasar Copywriting')

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

        <h5 class="text-center mb-4" style="font-weight:600;">Materi 2</h5>

        <p>
            Copywriting adalah seni menulis teks yang bertujuan untuk memengaruhi, mengajak, 
            atau meyakinkan audiens untuk melakukan tindakan tertentu. Fondasi utama copy yang 
            kuat selalu dimulai dari pemahaman audiens secara mendalam. Kamu perlu mengetahui 
            siapa yang membaca, masalah apa yang mereka hadapi, motivasi dan kebutuhan mereka, 
            serta bahasa yang biasa mereka gunakan. Semakin dalam pemahaman ini, semakin relevan 
            dan efektif copy yang kamu buat.        
        </p>

        <p>
            Sebelum menulis, tentukan pesan utama yang ingin disampaikan. Pesan ini harus jelas 
            dan fokus, agar audiens langsung memahami inti dari tulisanmu. Misalnya, “Produk ini 
            membantu pekerjaan lebih cepat” atau “Layanan ini membuatmu lebih hemat biaya.” Pesan 
            yang jelas akan menjaga copy tetap terarah dan mudah dimengerti.        
        </p>

        <p>
            Gaya bahasa juga memegang peranan penting dalam copywriting. Pilih gaya bahasa yang 
            sesuai dengan target audiens dan platform yang digunakan. Gaya persuasif mengajak pembaca 
            untuk bertindak, gaya emosional menyentuh perasaan, gaya informasional bersifat edukatif, 
            dan gaya friendly terasa santai dan dekat. Pemilihan gaya bahasa yang tepat membuat copy 
            lebih menarik dan dapat diterima audiens dengan baik.        
        </p>

        <p>
            Terakhir, susun struktur tulisan yang kuat agar copy mudah dibaca dan mengalir dengan 
            baik. Umumnya, copy yang efektif mengikuti alur: menarik perhatian pembaca, membuat mereka 
            tertarik dengan isi, membangkitkan keinginan, dan mengajak mereka untuk melakukan tindakan. 
            Struktur ini membantu tulisan terlihat profesional sekaligus persuasif.        
        </p>

    </div>


</div>

@endsection
