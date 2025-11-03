<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function show()
    {
        $about = Session::get('about', 'Saya seorang tuna rungu dengan semangat tinggi dan siap berkontribusi di dunia profesional. Meskipun menghadapi tantangan komunikasi, saya percaya kerja keras dan dedikasi adalah kunci kesuksesan.');

        $user = [
            'name' => 'Ruby Chan',
            'subtitle' => 'Tuna Rungu',
            'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=facearea&facepad=2',
            'about' => $about,
            'skills' => ['Web Development','Mobile Development','Desain Grafis','Content Writer','UI/UX Designer'],
            'documents' => [
                ['title'=>'CV','url'=>'#','desc'=>'Daftar riwayat hidup terbaru (PDF)'],
                ['title'=>'Resume','url'=>'#','desc'=>'Ringkasan 1 halaman untuk lamaran kerja'],
                ['title'=>'Portofolio','url'=>'#','desc'=>'Kumpulan karya & studi kasus'],
            ],
        ];

        return view('profile.show', compact('user'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate(['about'=>'required|string|max:500']);
        Session::put('about', $request->about);
        return back()->with('success','Bagian Tentang Saya berhasil diperbarui.');
    }
}
