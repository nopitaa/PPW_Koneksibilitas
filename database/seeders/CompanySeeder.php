<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'company_id' => 'AA101',
            'name' => 'Global TranIndo',
            'position' => 'Admin Toko Online',
            'status' => 'Pengajuan',
        ]);

        Company::create([
            'company_id' => 'AA102',
            'name' => 'PT Nusantara Digital',
            'position' => 'Admin Marketplace',
            'status' => 'Disetujui', // ⬅️ ubah dari "Diterima"
        ]);

        Company::create([
            'company_id' => 'AA103',
            'name' => 'CV Maju Jaya',
            'position' => 'Admin UMKM',
            'status' => 'Pengajuan',
        ]);

    }
}
