<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payroll>
 */
class PayrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payroll_id' => '',
            'employee_id' => '',
            'amount' => $this->faker->randomFloat(2, 1500, 6000),
            'payment_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'payment_method' => $this->faker->randomElement(['Bank Transfer', 'Cash', 'Check']),
            'reference' => strtoupper($this->faker->bothify('TRX-###-???-####')),
        ];
    }
}
