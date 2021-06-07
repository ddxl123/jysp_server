<?php

namespace Database\Factories;

use App\Models\FragmentPoolNode;
use Illuminate\Database\Eloquent\Factories\Factory;

class FragmentPoolNodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FragmentPoolNode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_aiid" => $this->faker->randomDigit,
            "pool_type" => $this->faker->randomDigit,
            "node_type" => $this->faker->randomDigit,
            "name" =>  $this->faker->asciify('*****'),
            "box_position" =>  $this->faker->randomDigit * 10 . "," . $this->faker->randomDigit * 10,
        ];
    }
}
