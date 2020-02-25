<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Model scope trait
     *
     * @param  Builder  $query
     * @param  QueryFilters  $filters
     *
     * @return Builder
     */
    public function scopeFilter(Builder $query, QueryFilters $filters): Builder
    {
        return $filters->apply($query);
    }
}
