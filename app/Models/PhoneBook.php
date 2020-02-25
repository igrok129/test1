<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PhoneBook
 *
 * @property integer $id
 * @property string $name
 * @property string $second_name
 * @property string $phone_number
 * @property string $country_code
 * @property string $timezone_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class PhoneBook extends Model
{
    use Filterable;

    protected $table = 'phone_book';
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['created_at'];
}
