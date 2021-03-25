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

        // $table->id("fragment_pool_node_id");
        // CustomTableId::x_id_no_primary($table, "user_id");
        // $table->tinyInteger("pool_type")->unsigned()->nullable(false);
        // $table->integer("node_type")->unsigned()->nullable(false);
        // $table->string("name", 50);
        // $table->string("position", 50);
        // $table->timestamps();
        return [
            "user_id" => $this->faker->randomDigit,
            "pool_type" => $this->faker->randomDigit,
            "node_type" => $this->faker->randomDigit,
            "name" =>  $this->faker->asciify('*****'),
            "position" =>  $this->faker->randomDigit * 10 . "," . $this->faker->randomDigit * 10,
        ];
    }
}
