<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Models\ValidationData;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('country_code', function ($attribute, $value, $parameters, $validator) {
            return ! ValidationData::whereRaw("JSON_CONTAINS_PATH(country_code, 'one', CONCAT('$.', ?)) > 0", $value)->get()->isEmpty();
        });
        Validator::extend('timezone_code', function ($attribute, $value, $parameters, $validator) {
            return ! ValidationData::whereRaw("JSON_CONTAINS_PATH(timezone_code, 'one', CONCAT('$.', ?)) > 0", '"' . $value . '"')->get()->isEmpty();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
