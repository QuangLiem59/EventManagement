<?php

namespace App\Containers\AppSection\Event\Data\Factories;

use App\Containers\AppSection\Event\Models\Event;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class EventFactory extends ParentFactory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
