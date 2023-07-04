<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tryout;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tryout>
 */
class TryoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Tryout::class;

    public function definition()
    {
        static $number = 1;

        return [
            'tryout_name' => 'Tryout ke-' . $number++,
            'tryout_date' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
        ];
    }
}
