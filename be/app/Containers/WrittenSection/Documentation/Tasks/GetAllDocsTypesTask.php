<?php

namespace App\Containers\WrittenSection\Documentation\Tasks;

use App\Containers\WrittenSection\Documentation\Exceptions\NoDocTypesFoundException;
use App\Ship\Parents\Tasks\Task;

class GetAllDocsTypesTask extends Task
{
    /**
     * @throws NoDocTypesFoundException
     */
    public function run(): array
    {
        if (!$configTypes = config('writtenSection-documentation.types')) {
            throw new NoDocTypesFoundException();
        }

        $types = [];
        foreach ($configTypes as $key => $value) {
            $types[] = $key;
        }

        // NOTE: type names must be the same as in the objects property (`public static $type = 'private';`)
        return $types;
    }
}
