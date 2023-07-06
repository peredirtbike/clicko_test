<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'address' => $this->faker->address,
            'email' => $this->faker->email,
        ];
    }
}