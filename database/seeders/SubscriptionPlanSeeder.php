<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Paket Basic',
                'description' => 'Cocok untuk pencari kerja yang ingin melamar ke beberapa perusahaan',
                'price' => 50000,
                'duration_in_days' => 30,
                'features' => json_encode([
                    'Maksimal 15 lamaran per hari',
                    'Akses ke semua lowongan',
                    'Notifikasi lowongan baru',
                    'Update status lamaran',
                ]),
                'is_active' => true,
            ],
            [
                'name' => 'Paket Professional',
                'description' => 'Cocok untuk pencari kerja yang aktif melamar ke banyak perusahaan',
                'price' => 100000,
                'duration_in_days' => 30,
                'features' => json_encode([
                    'Maksimal 30 lamaran per hari',
                    'Akses ke semua lowongan',
                    'Notifikasi lowongan baru',
                    'Update status lamaran',
                    'Prioritas lamaran',
                ]),
                'is_active' => true,
            ],
            [
                'name' => 'Paket Ultimate',
                'description' => 'Cocok untuk pencari kerja yang ingin fleksibilitas maksimal dalam melamar kerja',
                'price' => 150000,
                'duration_in_days' => 30,
                'features' => json_encode([
                    'Lamaran unlimited per hari',
                    'Akses ke semua lowongan',
                    'Notifikasi lowongan baru',
                    'Update status lamaran',
                    'Prioritas lamaran',
                    'Highlight profil ke perusahaan',
                ]),
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create($plan);
        }
    }
} 