<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SearchFilter implements EloquentFilterContract
{
    public function __construct(protected ?string $search = null, protected ?array $columns = [])
    {
    }
    public function applyEloquent(Builder|Model $model): Builder
    {
        return $model->when($this->search, function ($query) {
            return $query->where(function ($q) {
                foreach ($this->columns as $column) {
                    $q->orWhere($column, "LIKE", "%" . $this->search . "%");
                }
            });
        });
    }
}
