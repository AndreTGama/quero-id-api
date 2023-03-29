<?php

namespace Database\Factories;

use App\Models\TypeUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeUserFactory extends Factory
{
    protected $model = TypeUser::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $text = $this->faker->text(255);
        $private = rand(1,2);

        return [
            'name' => $name,
            'description' => $text,
            'private' => $private
        ];
    }
}
