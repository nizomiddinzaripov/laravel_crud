<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Author: Nizomiddin Zaripov
 * Date: 04/10/23 18:00
 * nizomiddinzaripov@yandex.com
 **/
interface EloquentFilterContract
{
    public function applyEloquent(Builder|Model $model): Builder;
}
