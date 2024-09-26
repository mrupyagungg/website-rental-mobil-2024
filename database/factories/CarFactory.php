<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'nama_mobil' => $this->faker->word,
            'slug' => Str::slug($this->faker->word),
            'type_id' => 1, // Adjust this if you have a Type model
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'transmisi' => $this->faker->paragraph,
            'penumpang' => $this->faker->numberBetween(2, 8),
            'unit' => $this->faker->numberBetween(2, 10),
            'description' => $this->faker->paragraph,
            'image' => 'path/to/image.jpg', // Or use $this->faker->imageUrl()
            'status' => $this->faker->randomElement([0, 1]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
