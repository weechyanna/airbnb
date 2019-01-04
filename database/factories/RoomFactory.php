<?php

use Faker\Generator as Faker;
use App\Room;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'price' => $faker->randomFLoat($nbMaxDecimals = 2, $min = 60, $max = 1000),
        'type' => $faker->randomElement($array = array('Entire place', 'Private room')),
        'location' => $faker->randomElement($array = array('Seattle', 'Los Angeles')),
        'user_id' => function(){
          return factory(App\User::class)->create()->id;
        }
    ];
});
