<?php

use Faker\Generator as Faker;

$factory->define(Modules\Crew\Entities\Crew\Crew::class, function (Faker $faker) {
    return [
        'username'             => '13720424367',
        'password'              => '$2y$10$LGXSPUyHcBV9whxKo7Tyb.xopMQhZoCpkJ1809suv9CaRDu.glkL.',
        'avatar'                => '',
    ];
});
