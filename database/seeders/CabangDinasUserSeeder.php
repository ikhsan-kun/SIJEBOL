<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CabangDinasUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'nik' => '1122334455667788',
        ], [
            'name' => 'Cabang Dinas User',
            'email' => 'cabang@jeboll.tegal.go.id',
            'phone' => '081234567890',
            'password' => \Illuminate\Support\Facades\Hash::make('cabang123'),
            'role' => 'cabang_dinas',
        ]);
    }
}
