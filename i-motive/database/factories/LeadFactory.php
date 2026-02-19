<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sources = [
            'website',
            'e-mail',
            'telefoon',
            'whatsapp',
            'showroom',
            'overig',
        ];

        $statusses = [
            'nieuw',
            'opgepakt',
            'proefrit',
            'offerte',
            'verkocht',
            'afgevallen',
        ];

        $name = $this->faker->name();
        $email = $this->faker->email();
        $source = $this->faker->randomElement($sources);
        $status = $this->faker->randomElement($statusses);

        return [
            'name' => $name,
            'email' => $email,
            'source' => $source,
            'status' => $status

        ];
    }
}
