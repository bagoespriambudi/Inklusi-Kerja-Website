<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobCategory;
use App\Models\JobListing;
use Illuminate\Database\Seeder;

class JobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all companies and categories
        $companies = Company::all();
        $categories = JobCategory::all();

        if ($companies->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Please run company and job category seeders first.');
            return;
        }

        $jobListings = [
            [
                'title' => 'Frontend Developer',
                'description' => 'Kami mencari Frontend Developer yang berpengalaman untuk bergabung dengan tim kami. Anda akan bertanggung jawab untuk mengembangkan antarmuka pengguna yang responsif dan intuitif.',
                'requirements' => "- Minimal 2 tahun pengalaman sebagai Frontend Developer\n- Mahir dalam HTML, CSS, JavaScript, dan framework modern (React/Vue/Angular)\n- Pemahaman yang kuat tentang UI/UX design principles\n- Kemampuan problem-solving yang baik\n- Dapat bekerja dalam tim maupun mandiri",
                'benefits' => "- Gaji kompetitif\n- BPJS Kesehatan & Ketenagakerjaan\n- Tunjangan transport\n- Remote working 2x seminggu\n- Lingkungan kerja yang dinamis",
                'employment_type' => 'Full-time',
                'experience_level' => 'Mid-Level',
                'location' => 'Jakarta',
                'salary_range' => 'Rp8.000.000 - Rp15.000.000',
                'deadline' => now()->addDays(30),
                'is_active' => true,
            ],
            [
                'title' => 'UI/UX Designer',
                'description' => 'Mencari UI/UX Designer kreatif untuk merancang pengalaman pengguna yang luar biasa. Anda akan bekerja sama dengan tim produk dan development untuk menciptakan desain yang inovatif.',
                'requirements' => "- Minimal 3 tahun pengalaman sebagai UI/UX Designer\n- Portofolio yang menunjukkan karya terbaik\n- Mahir menggunakan Figma, Adobe XD, atau tools desain lainnya\n- Pemahaman yang baik tentang design thinking dan user-centered design\n- Kemampuan komunikasi yang baik",
                'benefits' => "- Gaji kompetitif\n- Asuransi kesehatan\n- Tunjangan hari raya\n- Program pengembangan karir\n- Lingkungan kerja yang mendukung kreativitas",
                'employment_type' => 'Full-time',
                'experience_level' => 'Senior',
                'location' => 'Bandung',
                'salary_range' => 'Rp12.000.000 - Rp18.000.000',
                'deadline' => now()->addDays(25),
                'is_active' => true,
            ],
            [
                'title' => 'Backend Developer',
                'description' => 'Kami mencari Backend Developer yang berpengalaman untuk mengembangkan dan memelihara infrastruktur server-side kami.',
                'requirements' => "- Minimal 2 tahun pengalaman sebagai Backend Developer\n- Mahir dalam PHP/Laravel atau Node.js\n- Pemahaman yang kuat tentang database design dan optimization\n- Pengalaman dengan RESTful APIs\n- Kemampuan problem-solving yang baik",
                'benefits' => "- Gaji kompetitif\n- BPJS Kesehatan & Ketenagakerjaan\n- Tunjangan makan\n- Work from home flexibility\n- Training dan sertifikasi",
                'employment_type' => 'Full-time',
                'experience_level' => 'Mid-Level',
                'location' => 'Surabaya',
                'salary_range' => 'Rp10.000.000 - Rp16.000.000',
                'deadline' => now()->addDays(20),
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing Specialist',
                'description' => 'Mencari Digital Marketing Specialist yang kreatif untuk merencanakan dan mengeksekusi strategi pemasaran digital perusahaan.',
                'requirements' => "- Minimal 2 tahun pengalaman di bidang digital marketing\n- Pemahaman yang kuat tentang SEO, SEM, dan social media marketing\n- Kemampuan analitis yang baik\n- Kreativitas dalam menciptakan konten\n- Kemampuan komunikasi yang baik",
                'benefits' => "- Gaji kompetitif\n- Asuransi kesehatan\n- Bonus performance\n- Flexible working hours\n- Training dan sertifikasi digital marketing",
                'employment_type' => 'Full-time',
                'experience_level' => 'Mid-Level',
                'location' => 'Jakarta',
                'salary_range' => 'Rp7.000.000 - Rp12.000.000',
                'deadline' => now()->addDays(15),
                'is_active' => true,
            ],
            [
                'title' => 'Content Writer',
                'description' => 'Kami mencari Content Writer berbakat untuk menciptakan konten yang menarik dan informatif untuk berbagai platform digital.',
                'requirements' => "- Minimal 1 tahun pengalaman sebagai content writer\n- Kemampuan menulis yang sangat baik dalam Bahasa Indonesia dan Inggris\n- Pemahaman tentang SEO content writing\n- Kreativitas dalam mengembangkan ide konten\n- Kemampuan riset yang baik",
                'benefits' => "- Gaji kompetitif\n- Asuransi kesehatan\n- Tunjangan pulsa internet\n- Flexible working hours\n- Lingkungan kerja yang mendukung kreativitas",
                'employment_type' => 'Full-time',
                'experience_level' => 'Entry-Level',
                'location' => 'Remote',
                'salary_range' => 'Rp5.000.000 - Rp8.000.000',
                'deadline' => now()->addDays(10),
                'is_active' => true,
            ],
            [
                'title' => 'Product Manager',
                'description' => 'Mencari Product Manager yang berpengalaman untuk memimpin pengembangan produk digital kami.',
                'requirements' => "- Minimal 4 tahun pengalaman sebagai Product Manager\n- Pemahaman yang kuat tentang product development lifecycle\n- Kemampuan leadership yang baik\n- Analytical thinking dan problem-solving skills\n- Kemampuan komunikasi yang excellent",
                'benefits' => "- Gaji sangat kompetitif\n- Asuransi kesehatan keluarga\n- Bonus tahunan\n- Stock options\n- Program pengembangan kepemimpinan",
                'employment_type' => 'Full-time',
                'experience_level' => 'Senior',
                'location' => 'Jakarta',
                'salary_range' => 'Rp25.000.000 - Rp35.000.000',
                'deadline' => now()->addDays(45),
                'is_active' => true,
            ],
        ];

        foreach ($jobListings as $listing) {
            JobListing::create(array_merge($listing, [
                'company_id' => $companies->random()->id,
                'job_category_id' => $categories->random()->id,
            ]));
        }
    }
} 