<?php

namespace Database\Factories;

use App\Enums\SupplierType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'shopname' => fake()->company(),
            'type' => fake()->randomElement([
                SupplierType::DISTRIBUTOR->value,
                SupplierType::WHOLESALER->value,
                SupplierType::PRODUCER->value
            ]),
            'account_holder' => fake()->name(),
            'account_number' => fake()->numerify('########'),
            'bank_name' => fake()->randomElement(['Mandiri', 'BCA', 'BNI', 'BRI']),
        ];
    }
}
