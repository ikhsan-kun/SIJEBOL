<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            \Database\Seeders\CabangDinasUserSeeder::class,
        ]);

        User::updateOrCreate([
            'nik' => '1234567890123456',
        ], [
            'name' => 'Admin Jebol',
            'email' => 'admin@jebol.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
        ]);

// Test user placeholder removed – no default user needed
    }
}
