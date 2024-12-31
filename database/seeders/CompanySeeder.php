<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'PT Teknologi Maju Indonesia',
                'description' => 'Perusahaan teknologi terkemuka yang fokus pada pengembangan solusi digital inovatif untuk berbagai industri.',
                'website' => 'https://tekno-maju.id',
                'location' => 'Jakarta',
                'industry' => 'Technology',
                'email' => 'careers@tekno-maju.id',
                'phone' => '021-5551234',
                'address' => 'Jl. Sudirman No. 123, Jakarta Selatan',
                'is_verified' => true,
            ],
            [
                'name' => 'PT Kreatif Digital Nusantara',
                'description' => 'Studio kreatif yang mengkhususkan diri dalam desain, branding, dan pengembangan konten digital.',
                'website' => 'https://kreatif-digital.co.id',
                'location' => 'Bandung',
                'industry' => 'Creative Agency',
                'email' => 'hello@kreatif-digital.co.id',
                'phone' => '022-4445678',
                'address' => 'Jl. Dago No. 45, Bandung',
                'is_verified' => true,
            ],
            [
                'name' => 'PT Finansial Teknologi Indonesia',
                'description' => 'Perusahaan fintech yang menyediakan solusi pembayaran digital dan manajemen keuangan.',
                'website' => 'https://fintech-id.com',
                'location' => 'Jakarta',
                'industry' => 'Financial Technology',
                'email' => 'info@fintech-id.com',
                'phone' => '021-7778899',
                'address' => 'Jl. Gatot Subroto No. 567, Jakarta Selatan',
                'is_verified' => true,
            ],
            [
                'name' => 'PT Edukasi Pintar Indonesia',
                'description' => 'Platform pendidikan online yang menyediakan kursus dan pelatihan untuk berbagai bidang.',
                'website' => 'https://edukasi-pintar.id',
                'location' => 'Yogyakarta',
                'industry' => 'Education Technology',
                'email' => 'support@edukasi-pintar.id',
                'phone' => '0274-334455',
                'address' => 'Jl. Malioboro No. 89, Yogyakarta',
                'is_verified' => true,
            ],
            [
                'name' => 'PT Solusi Kesehatan Digital',
                'description' => 'Startup healthtech yang mengembangkan aplikasi konsultasi kesehatan online dan manajemen rekam medis.',
                'website' => 'https://sehat-digital.co.id',
                'location' => 'Surabaya',
                'industry' => 'Healthcare Technology',
                'email' => 'contact@sehat-digital.co.id',
                'phone' => '031-9990001',
                'address' => 'Jl. Pemuda No. 234, Surabaya',
                'is_verified' => true,
            ],
            [
                'name' => 'PT E-Commerce Sejahtera',
                'description' => 'Platform e-commerce yang menghubungkan UMKM dengan pasar nasional.',
                'website' => 'https://ecommerce-sejahtera.id',
                'location' => 'Jakarta',
                'industry' => 'E-Commerce',
                'email' => 'business@ecommerce-sejahtera.id',
                'phone' => '021-8889900',
                'address' => 'Jl. Kuningan No. 789, Jakarta Selatan',
                'is_verified' => true,
            ],
            [
                'name' => 'PT Agritech Nusantara',
                'description' => 'Perusahaan teknologi pertanian yang mengembangkan solusi smart farming.',
                'website' => 'https://agritech-nusantara.co.id',
                'location' => 'Malang',
                'industry' => 'Agricultural Technology',
                'email' => 'info@agritech-nusantara.co.id',
                'phone' => '0341-223344',
                'address' => 'Jl. Soekarno Hatta No. 123, Malang',
                'is_verified' => true,
            ],
            [
                'name' => 'PT Logistik Digital Indonesia',
                'description' => 'Perusahaan logistik yang menggunakan teknologi untuk optimasi pengiriman dan manajemen gudang.',
                'website' => 'https://logistik-digital.id',
                'location' => 'Tangerang',
                'industry' => 'Logistics',
                'email' => 'ops@logistik-digital.id',
                'phone' => '021-5556677',
                'address' => 'Jl. Raya Serpong No. 456, Tangerang',
                'is_verified' => true,
            ],
            [
                'name' => 'PT Media Digital Kreasi',
                'description' => 'Perusahaan media digital yang fokus pada konten kreatif dan marketing digital.',
                'website' => 'https://media-kreasi.id',
                'location' => 'Jakarta',
                'industry' => 'Digital Media',
                'email' => 'creative@media-kreasi.id',
                'phone' => '021-4443333',
                'address' => 'Jl. Kemang No. 890, Jakarta Selatan',
                'is_verified' => true,
            ],
            [
                'name' => 'PT Smart Energy Indonesia',
                'description' => 'Perusahaan energi terbarukan yang mengembangkan solusi energi pintar.',
                'website' => 'https://smart-energy.co.id',
                'location' => 'Surabaya',
                'industry' => 'Renewable Energy',
                'email' => 'contact@smart-energy.co.id',
                'phone' => '031-7776655',
                'address' => 'Jl. Darmo No. 345, Surabaya',
                'is_verified' => true,
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
} 