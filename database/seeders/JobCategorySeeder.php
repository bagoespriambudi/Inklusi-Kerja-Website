<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Teknologi Informasi',
                'description' => 'Pekerjaan di bidang teknologi informasi, pengembangan perangkat lunak, dan sistem informasi.',
            ],
            [
                'name' => 'Keuangan & Akuntansi',
                'description' => 'Pekerjaan di bidang keuangan, akuntansi, audit, dan perbankan.',
            ],
            [
                'name' => 'Pemasaran & Penjualan',
                'description' => 'Pekerjaan di bidang pemasaran, penjualan, digital marketing, dan hubungan pelanggan.',
            ],
            [
                'name' => 'Sumber Daya Manusia',
                'description' => 'Pekerjaan di bidang manajemen SDM, rekrutmen, dan pengembangan organisasi.',
            ],
            [
                'name' => 'Administrasi & Sekretaris',
                'description' => 'Pekerjaan di bidang administrasi perkantoran, sekretaris, dan manajemen kantor.',
            ],
            [
                'name' => 'Desain & Kreatif',
                'description' => 'Pekerjaan di bidang desain grafis, UI/UX, multimedia, dan industri kreatif.',
            ],
            [
                'name' => 'Pendidikan & Pengajaran',
                'description' => 'Pekerjaan di bidang pendidikan, pengajaran, dan pelatihan.',
            ],
            [
                'name' => 'Kesehatan & Medis',
                'description' => 'Pekerjaan di bidang kesehatan, kedokteran, keperawatan, dan farmasi.',
            ],
            [
                'name' => 'Manufaktur & Produksi',
                'description' => 'Pekerjaan di bidang manufaktur, produksi, dan pengendalian kualitas.',
            ],
            [
                'name' => 'Konstruksi & Properti',
                'description' => 'Pekerjaan di bidang konstruksi, arsitektur, dan manajemen properti.',
            ],
            [
                'name' => 'Media & Komunikasi',
                'description' => 'Pekerjaan di bidang media, jurnalistik, public relations, dan komunikasi.',
            ],
            [
                'name' => 'Logistik & Supply Chain',
                'description' => 'Pekerjaan di bidang logistik, supply chain, dan manajemen inventori.',
            ],
            [
                'name' => 'Customer Service',
                'description' => 'Pekerjaan di bidang layanan pelanggan dan dukungan konsumen.',
            ],
            [
                'name' => 'Legal & Hukum',
                'description' => 'Pekerjaan di bidang hukum, legal, dan kepatuhan.',
            ],
            [
                'name' => 'Riset & Pengembangan',
                'description' => 'Pekerjaan di bidang penelitian, pengembangan produk, dan inovasi.',
            ],
        ];

        foreach ($categories as $category) {
            JobCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
} 