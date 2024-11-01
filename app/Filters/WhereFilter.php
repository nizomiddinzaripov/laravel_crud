<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Author: nizomiddin
 * Date: 4/1/24 4:12 PM
 **/
class WhereFilter implements EloquentFilterContract
{
    public function __construct(
        protected string $column,
        protected ?string $value,
        protected string $operator = '='
    ) {
    }

    public function applyEloquent(Builder|Model $model): Builder
    {
        return $model->when(is_numeric($this->value), fn($q) => $q->where($this->column, $this->operator, $this->value));
    }
}
