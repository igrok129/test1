<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PhoneBook::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'second_name' => $faker->lastName,
        'phone_number' => $faker->e164PhoneNumber,
        'country_code' => $faker->countryCode,
        'timezone_code' => $faker->timezone,
    ];
});
