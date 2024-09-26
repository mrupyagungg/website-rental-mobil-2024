<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        Car::factory()->count(50)->create();
    }
}
