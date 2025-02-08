<?php

namespace App\Containers\AppWrittenSectionSection\Welcome\Actions;

use App\Ship\Parents\Actions\Action;

class FindMessageForApiV1VisitorAction extends Action
{
    public function run(): array
    {
        return ['Welcome (API V1)'];
    }
}
