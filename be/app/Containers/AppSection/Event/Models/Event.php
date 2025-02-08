<?php

namespace App\Containers\AppSection\Event\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Event extends ParentModel
{
    protected $fillable = [
        'title',
        'content',
        'date',
        'location',
        'capacity',
    ];

    protected $hidden = [];

    protected $casts = [
        'date' => 'date',
        'capacity' => 'integer',
    ];

    protected $table = 'events';

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Event';

    public static function getTableName()
    {
        return 'events';
    }

    public function register()
    {
        return $this->hasMany(EventRegister::class);
    }
}
