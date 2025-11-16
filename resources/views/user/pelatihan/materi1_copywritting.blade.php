@extends('layouts.user')

@section('title', 'Materi 1 - Social Media Marketing')

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

        <h5 class="text-center mb-4" style="font-weight:600;">Materi 1</h5>

        <p>
            Copywriting adalah seni dan teknik menulis teks yang dirancang untuk mempengaruhi pembaca 
            agar melakukan tindakan tertentu, seperti membeli produk, mengikuti akun, mendaftar layanan, 
            atau sekadar tertarik pada sebuah brand. Copywriting digunakan dalam berbagai bentuk konten seperti 
            iklan, caption, landing page, email marketing, website, hingga kampanye promosi.        
        </p>

        <p>
            Tujuan utama dari copywriting meliputi menarik perhatian pembaca, membangun ketertarikan, menciptakan rasa 
            ingin tahu, memberikan nilai atau manfaat, hingga mendorong pembaca untuk melakukan tindakan. Semakin kuat 
            pesan yang disampaikan, semakin besar peluang terjadinya konversi atau respon dari audiens.        
        </p>

        <p>
            Dalam copywriting, pemahaman terhadap audiens adalah hal yang sangat penting. Mengetahui siapa pembaca, 
            apa kebutuhan mereka, apa masalah yang mereka hadapi, serta gaya bahasa yang sesuai akan membuat tulisan 
            terasa lebih personal dan relevan.        
        </p>

        <p>
            Selain itu, struktur tulisan juga sangat memengaruhi efektivitas copywriting. Kalimat pembuka yang kuat, 
            pesan yang jelas, manfaat yang ditonjolkan, serta ajakan tindakan (CTA) yang tepat dapat meningkatkan respon 
            audiens secara signifikan.        
        </p>

        <p>
            Pada materi pertama ini, kamu akan mempelajari dasar-dasar copywriting, bagaimana sebuah tulisan dapat 
            mempengaruhi perilaku pembaca, serta bagaimana membangun pesan yang persuasif dan mampu memperkuat identitas sebuah brand.        
        </p>

    </div>

</div>

@endsection
