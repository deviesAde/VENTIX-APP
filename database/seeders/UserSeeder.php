<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Organizer
        User::create([
            'name' => 'Organizer User',
            'email' => 'organizer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
        ]);

        // Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
