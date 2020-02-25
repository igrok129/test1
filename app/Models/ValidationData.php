<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidationData extends Model
{
    protected $table = 'validation_data';

    protected $casts = [
        'country_code'  => 'array',
        'timezone_code'      => 'array'
    ];
}
