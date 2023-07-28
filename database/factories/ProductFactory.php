<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $files = app('firebase.firestore')->database()->collection('Images');
        $files = Storage::files('public/images');
        $randomFile = Arr::random($files);
        $imageUrl = Storage::url($randomFile);

        return [
            'title' => 'HyperX - ' . fake()->text(100),
            'image' => $imageUrl,
            // 'image' => fake()->imageUrl(),
            'description' => fake()->realText(200),
            'price' => fake()->randomFloat(2, 50, 500),
            'published' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
