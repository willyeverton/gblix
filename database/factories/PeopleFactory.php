<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = People::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            '_id'        => $this->faker->uuid,
            'name'       => $this->faker->name,
            'gender'     => $this->faker->word,
            'age'        => $this->faker->numberBetween(1, 90),
            'eye_color'  => $this->faker->colorName,
            'hair_color' => $this->faker->colorName,
        ];
    }
}
