<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WithRelationshipCriteria extends Criteria
{
    public function __construct(
        private string $with,
        private string $column,
        private string|array $value,
    ) {
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereHas($this->with, function ($query) {
            if (is_array($this->value)) {
                $query->whereIn($this->column, $this->value);
            } else {
                $query->where($this->column, $this->value);
            }
        });
    }
}
