<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recommendation>
 */
class RecommendationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $decisions =["sangat direkomendasikan", "direkomendasikan", "tidak direkomendasikan"];
        return [
            'student_id' => $this->faker->numberBetween(1,7),
            'major_id' => $this->faker->numberBetween(355001,355025),
            'university_id' => $this->faker->numberBetween(111,171),
            'decision' => $this->faker->randomElement($decisions),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
