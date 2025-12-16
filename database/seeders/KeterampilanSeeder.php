<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeterampilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Design Grafis',
            'Mobile Developer',
            'Web Development',
            'UI/UX Designer',
            'Data Analyst',
            'SEO',
            'Copywriting',
            'Social Media Management',
            'Project Management',
            'DevOps',
        ];

        foreach ($skills as $name) {
            DB::table('keterampilan')->updateOrInsert([
                'nama_keterampilan' => $name,
            ]);
        }
    }
}
