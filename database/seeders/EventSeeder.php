<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizer; // Pastikan model Organizer sudah dibuat
use App\Models\Event; // Pastikan model Event sudah dibuat

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua organizer
        $organizers = Organizer::all();

        // Buat 5 event untuk setiap organizer
        foreach ($organizers as $organizer) {
            Event::factory()->count(5)->create([
                'organizer_id' => $organizer->id,
            ]);
        }
    }
}
