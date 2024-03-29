<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $table->id("user_aiid");
        // $table->char("username", 100)->nullable(false);
        // $table->char("password", 100)->nullable(false);
        // $table->char("email", 20)->nullable(true)->unique();
        // $table->timestamps();
        return [
            // 'name' => $this->faker->name,
            // 'email' => $this->faker->unique()->safeEmail,
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),

            'username' => $this->faker->name,
            'password' => '$2y$10$92IXU1Npk3jO0rO', // password
            'email' => null,
        ];
    }
}
