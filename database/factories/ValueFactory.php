<?php

namespace Database\Factories;

use App\Models\Value;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Value>
 */
class ValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Value::class;

    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 7),
            'subject_id' => $this->faker->numberBetween(1, 6),
            'tryout_id' => $this->faker->numberBetween(1, 5),
            'value' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
