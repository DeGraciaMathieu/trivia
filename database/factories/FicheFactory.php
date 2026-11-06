<?php

namespace Database\Factories;

use App\Models\Fiche;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fiche>
 */
class FicheFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $term = fake()->unique()->word();

        return [
            'slug' => $term,
            'terme' => $term,
            'categorie' => fake()->randomElement(Fiche::CATEGORIES),
            'date_libelle' => '1970, Unix',
            'teaser' => fake()->sentence(),
            'retenir' => fake()->sentence(),
            'aujourdhui' => fake()->paragraph(),
            'recit_1' => fake()->paragraph(8),
            'recit_2' => fake()->paragraph(8),
            'recit_3' => fake()->paragraph(8),
            'ordre' => fake()->unique()->numberBetween(1, 10000),
        ];
    }
}
