<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizer; // Pastikan model Organizer sudah dibuat

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


        public function run(): void
        {
            Organizer::factory()->count(10)->create(); // Menggunakan factory untuk membuat 10 organizer
        }

}
