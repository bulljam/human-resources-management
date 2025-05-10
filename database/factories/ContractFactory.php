<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => '',
            'designation_id' => '',
            'rate' => $this->faker->randomFloat(2, 2000, 7000),
            'rate_type' => $this->faker->randomElement(['monthly', 'daily']),
            'start_date' => $this->faker->dateTimeBetween('-2 years', '-6 months'),
            'end_date' => \Carbon\Carbon::now()->addYear(), 
        ];
    }
}
