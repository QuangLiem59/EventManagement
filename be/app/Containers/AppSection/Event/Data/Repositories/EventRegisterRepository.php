<?php

namespace App\Containers\AppSection\Event\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class EventRegisterRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'name' => 'like',
    ];
}
