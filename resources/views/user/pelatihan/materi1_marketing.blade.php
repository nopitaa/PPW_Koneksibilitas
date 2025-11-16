@extends('layouts.user')

@section('title', 'Materi 1 - Social Media Marketing')

@section('content')

<div class="container py-3">

    {{-- Back Button --}}
    <a href="{{ route('marketing') }}" class="text-decoration-none mb-3 d-inline-flex align-items-center"
       style="font-size: 15px;">
        <i class="bi bi-arrow-left me-1"></i> 
    </a>

    {{-- Content Card --}}
    <div class="card shadow-sm p-4"
         style="max-width: 850px; margin:auto; border-radius:14px; border:1px solid #eee;">

        <h5 class="text-center mb-4" style="font-weight:600;">Materi 1</h5>

        <p>
            Social Media Marketing (SMM) adalah strategi pemasaran yang memanfaatkan 
            platform media sosial seperti Instagram, TikTok, Facebook, dan YouTube 
            untuk membangun brand, meningkatkan interaksi, dan menjangkau audiens yang lebih luas.
        </p>

        <p>
            Tujuan utama dari SMM meliputi meningkatkan brand awareness, menaikkan engagement, 
            memperluas jangkauan konten, membangun komunitas, hingga meningkatkan penjualan 
            melalui konten yang relevan dan terarah.
        </p>

        <p>
            Dalam SMM, konten adalah elemen paling penting. Konten yang menarik, informatif, dan 
            konsisten dapat meningkatkan kepercayaan audiens dan membuat mereka lebih dekat dengan brand.
        </p>

        <p>
            Selain itu, pemahaman terhadap algoritma media sosial juga penting. Algoritma akan menampilkan 
            konten yang dianggap relevan dan disukai audiens. Karena itu, interaksi seperti like, komen, 
            share, dan save sangat berpengaruh.
        </p>

        <p>
            Pada materi pertama ini, kamu akan mempelajari dasar-dasar SMM, bagaimana konten dapat memengaruhi 
            pertumbuhan akun, dan bagaimana membangun kehadiran brand yang kuat di media sosial.
        </p>

    </div>

</div>

@endsection
