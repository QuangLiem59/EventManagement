<?php

namespace App\Containers\AppSection\Event\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class EventRegister extends ParentModel
{
    protected $fillable = [
        'event_id',
        'name',
        'gender',
        'email',
        'phone',
    ];

    protected $hidden = [];

    protected $casts = [
        'event_id' => 'integer',
    ];

    protected $table = 'event_register';

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'EventRegister';

    public static function getTableName()
    {
        return 'event_register';
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
