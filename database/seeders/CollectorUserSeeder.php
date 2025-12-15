<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CollectorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::updateOrCreate(
            ['email' => 'collector@gmail.com'],
            [
                'name' => 'Collector',
                'password' => Hash::make('password123'),  // HARD-CODED PASSWORD
                'admin' => 0,
                'role' => 'collector',
            ]
        );
    }
}
