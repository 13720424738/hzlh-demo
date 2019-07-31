<?php

use Faker\Generator as Faker;

$factory->define(Modules\User\Entities\User\User::class, function (Faker $faker) {
    return [
        'cellphone'             => '13720424367',
        'password'              => '$2y$10$LGXSPUyHcBV9whxKo7Tyb.xopMQhZoCpkJ1809suv9CaRDu.glkL.',
        'avatar'                => '',
    ];
});
