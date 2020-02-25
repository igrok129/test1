<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilters
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * apply filters
     *
     * @param  Builder  $builder
     *
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ((array)$this->getFilters() as $filter => $value) {
            $filter = lcfirst(implode('', array_map('ucfirst', explode('_', $filter))));

            if (! method_exists($this, $filter)) {
                continue;
            }
            $this->$filter($value);
        }

        return $this->builder;
    }

    /**
     * Get data from request
     *
     * @return  array
     */
    public function getFilters(): array
    {
        return $this->request->all();
    }
}
