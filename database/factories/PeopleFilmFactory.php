<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\People;
use App\Models\PeopleFilm;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeopleFilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PeopleFilm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'people_id' => People::factory(),
            'film_id'   => Film::factory(),
        ];
    }
}
