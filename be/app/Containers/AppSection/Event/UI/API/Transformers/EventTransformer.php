<?php

namespace App\Containers\AppSection\Event\UI\API\Transformers;

use App\Containers\AppSection\Event\Models\Event;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class EventTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [
        'register',
    ];

    public function transform(Event $event): array
    {
        $response = [
            'object' => $event->getResourceKey(),
            'id' => $event->getHashedKey(),
            'title' => $event->title,
            'content' => $event->content,
            'date' => $event->date->format('Y-m-d'),
            'location' => $event->location,
            'capacity' => $event->capacity,
            'registered' => $event->register()->count(),
        ];

        return $this->ifAdmin([
            'real_id' => $event->id,
            'created_at' => $event->created_at,
            'updated_at' => $event->updated_at,
        ], $response);
    }

    public function includeRegister(Event $event)
    {
        return $this->collection($event->register, new EventRegisterTransformer());
    }
}
