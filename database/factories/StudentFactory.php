<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Student;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;

    public function definition()
    {
        // $dataSekolah = [
        //     'SMA Negeri 1 Jakarta',
        //     'SMA Negeri 2 Surabaya',
        //     'SMA Negeri 3 Bandung',
        //     'SMA Negeri 4 Yogyakarta',
        //     'SMA Negeri 5 Semarang',
        //     'SMA Negeri 6 Medan',
        //     'SMA Negeri 7 Makassar',
        //     'SMA Negeri 8 Palembang',
        //     'SMK Negeri 1 Jakarta',
        //     'SMK Negeri 2 Surabaya',
        //     'SMK Negeri 3 Bandung',
        //     'SMK Negeri 4 Yogyakarta',
        //     'SMK Negeri 5 Semarang',
        //     'SMK Negeri 6 Medan',
        //     'SMK Negeri 7 Makassar',
        //     'SMK Negeri 8 Palembang',
        // ];

        // $users = User::where('is_admin', false)->get();
        // $data = [];
        
        // $users = User::where('is_admin', false)->select('id', 'name')->get();
        // $users = User::where('is_admin', false)->orderBy('id')->select('id')->get();
        // // $user = User::where('is_admin', false)->pulck;
        // foreach ($users as $user){
            return [
                'room_id' => $this->faker->numberBetween(1,5),
                'name' => $this->faker->name(),
                'telp' => $this->faker->phoneNumber(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        // }
    }
}
