<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    return [
       'name'=> $faker->company,
       'description'=>$faker->text(200),
       'city'=>$faker->city,
       'state'=>$faker->state,
       'zip'=>$faker->postcode,
       'address'=>$faker->address,
       'lat'=>$faker->latitude(19.5,64.5),
       'lng' => $faker->longitude(-161.75583, -68.01197)
    ];
});
