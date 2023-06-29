<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Database\Eloquent\Factories\Factory;
class ActionFactory extends Factory
{
    protected $model = Action::class;

    public function definition()
    {
        return [
            'userId' => $this->faker->numberBetween(1, 1000000),
            'actionKey' => $this->faker->randomElement(['delete-order', 'save-order', 'update-order']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'date' => $this->faker->date(),
            'info' => [
                'number' => $this->faker->bothify('???-#####'),
                'clientId' => $this->faker->numberBetween(1, 1000000),
                'products' => [
                    $this->faker->numberBetween(100, 999),
                    $this->faker->numberBetween(100, 999),
                    $this->faker->numberBetween(100, 999),
                ],
            ],
        ];
    }
}