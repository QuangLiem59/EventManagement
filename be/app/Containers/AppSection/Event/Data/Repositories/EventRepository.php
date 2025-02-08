<?php

namespace App\Containers\AppSection\Event\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class EventRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'title' => 'like',
    ];
}
