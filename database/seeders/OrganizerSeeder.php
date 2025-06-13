<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organizer;

class OrganizerSeeder extends Seeder
{
    public function run(): void
    {
        Organizer::insert([
            [
                'user_id' => null, // belum di-approve
                'organization_name' => 'EventPro ID',
                'description' => 'Penyelenggara berbagai event musik dan seminar.',
                'phone' => '081234567890',
                'website' => 'https://eventpro.id',
                'logo_path' => null,
                'status' => 'pending',
                'email' => 'depppiis123@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null, // belum di-approve
                'organization_name' => 'Konser Mantap',
                'description' => 'Organizer konser skala nasional.',
                'phone' => '081298765432',
                'website' => 'https://konsermantap.co.id',
                'logo_path' => null,
                'status' => 'pending',
                'email' => 'kaosjebol05@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'organization_name' => 'Tech Talks',
                'description' => 'Komunitas penyelenggara seminar teknologi.',
                'phone' => '085612345678',
                'website' => 'https://techtalks.org',
                'logo_path' => null,
                'status' => 'approved',
                'email' => 'tech@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
