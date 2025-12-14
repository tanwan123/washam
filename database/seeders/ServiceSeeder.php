<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          Service::create([
            'name' => 'Shoes',
            'description' => 'Wash and polish shoes',
            'price' => 1500
        ]);

        Service::create([
            'name' => 'Shirts',
            'description' => 'Wash and iron shirts',
            'price' => 500
        ]);
        Service::create([
            'name' => 'underwear',
            'description' => 'Wash and iron pants',
            'price' => 700
        ]);
        Service::create([
            'name' => 'Bedsheets',
            'description' => 'Wash and iron bedsheets',
            'price' => 1200     
        ]);
        Service::create([
            'name' => 'Jackets',
            'description' => 'Wash and iron jackets',
            'price' => 2000
        ]);
        Service::create([
            'name' => 'daily wear',
            'description' => 'Wash and iron dresses',
            'price' => 1800
        ]);
        Service::create([
            'name' => 'Suits',
            'description' => 'Wash and iron suits',
            'price' => 2500
        ]);  
        Service::create([
            'name' => 'Curtains',
            'description' => 'Wash and iron curtains',
            'price' => 3000
        ]);


    }
}
