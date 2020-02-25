<?php

namespace App\Filters;

class PhoneBookFilter extends QueryFilters
{
    public function id($value)
    {
        $this->builder->whereId($value);
    }

    public function name($value)
    {
        $this->builder->where('name', 'LIKE', $value);
    }

    public function secondName($value)
    {
        $this->builder->where('second_name', 'LIKE', $value);
    }
}
