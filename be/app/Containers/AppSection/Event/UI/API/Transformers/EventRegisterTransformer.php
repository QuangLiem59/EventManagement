<?php

namespace App\Containers\AppSection\Event\UI\API\Transformers;

use App\Containers\AppSection\Event\Models\EventRegister;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class EventRegisterTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [
        'event',
    ];

    public function transform(EventRegister $eventRegister): array
    {
        $response = [
            'object' => $eventRegister->getResourceKey(),
            'id' => $eventRegister->getHashedKey(),
            'name' => $eventRegister->name,
            'gender' => $eventRegister->gender,
            'email' => $eventRegister->email,
            'phone' => $eventRegister->phone,
        ];

        return $this->ifAdmin([
            'real_id' => $eventRegister->id,
            'created_at' => $eventRegister->created_at,
            'updated_at' => $eventRegister->updated_at,
        ], $response);
    }

    public function includeEvent(EventRegister $eventRegister)
    {
        return $this->item($eventRegister->event, new EventTransformer());
    }
}
