<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $emailProviders = ['gmail.com', 'hotmail.com'];
        $randomEmailProvider = $emailProviders[array_rand($emailProviders)];

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmailDomain($randomEmailProvider),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}