<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog>
 */
class CatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // Menggunakan 'word' untuk nama pendek
            'category' => $this->faker->randomElement(['Decoration', 'Additional Item']),
            'description' => $this->faker->paragraph, // Menggunakan 'paragraph' untuk teks deskripsi lebih panjang
            'image' => json_encode([$this->faker->imageUrl()]), // 'image' di-cast sebagai array, jadi kita mengembalikan URL dalam bentuk JSON
            'price' => $this->faker->randomFloat(2, 0, 1000), // Harga acak dengan 2 desimal antara 0 dan 1000
        ];
    }
}
