<?php

namespace App\Containers\AppSection\User\Data\Factories;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Factories\Factory as ParentFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends ParentFactory
{
    protected $model = User::class;

    public function definition(): array
    {
        static $password;

        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->unique()->random(5),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password ?: $password = Hash::make('testing-password'),
            'gender' => $this->faker->randomElement(['male', 'female', 'unspecified']),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(config('appSection-authorization.admin_role'));
        });
    }

    public function unverified(): static
    {
    
    }
}
