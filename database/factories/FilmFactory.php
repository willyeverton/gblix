<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            '_id'          => $this->faker->uuid,
            'rt_score'     => $this->faker->numberBetween(1, 100),
            'producer'     => $this->faker->name,
            'description'  => $this->faker->text,
            'title'        => $this->faker->name,
            'director'     => $this->faker->name,
            'release_date' => $this->faker->year,
        ];
    }
}
