<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DungCu>
 */
class DungCuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'maLoaiDC' => $this->faker->numberBetween(1, 100), // Assuming you have 100 types of equipment
            'tenDungCu' => $this->faker->word(),
            'soLuongCon' => $this->faker->numberBetween(0, 100),
            'soLuongChoThue' => 0, // Always set to 50
            'trangThai' => $this->faker->randomElement(['available', 'unavailable']), // Example statuses
            'moTa' => $this->faker->sentence(),
            'hinhAnh1' => $this->faker->imageUrl(), // Generates a random image URL
            'donGiaGoc' => 200000,
            'donGiaThue' => $this->faker->randomFloat(2, 1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
