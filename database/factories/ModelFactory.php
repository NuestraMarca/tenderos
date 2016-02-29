<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Tenderos\Entities\User;
use Tenderos\Entities\Deparment;
use Tenderos\Entities\Municipality;
use Tenderos\Entities\Category;
use Tenderos\Entities\Product;


$factory->define(User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->username,
        'email' => $faker->email,
        'password' => 'gobernacionmeta',
        'remember_token' => str_random(10),
        'type' => 'registered',
        'tel' => $faker->phoneNumber,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'municipality_id' => 1
    ];
});

$factory->define(Deparment::class, function ($faker) {
    return [
        'name' => $faker->unique()->city
    ];
});

$factory->define(Municipality::class, function ($faker) {
    return [
        'name' => $faker->unique()->city
    ];
});

$factory->define(Category::class, function ($faker) {
    return [
        'name' => $faker->unique()->name
    ];
});

$factory->define(Product::class, function ($faker) {
    return [
        'name' => $faker->unique()->name
    ];
});

$factory->defineAs(User::class, 'admin', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['type' => 'admin']);
});

$factory->defineAs(User::class, 'shopkeeper', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['type' => 'shopkeeper']);
});

$factory->defineAs(User::class, 'producer', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['type' => 'producer']);
});

$factory->defineAs(User::class, 'admin_default', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['username' => 'admin', 'type' => 'admin']);
});

$factory->defineAs(User::class, 'shopkeeper_default', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['username' => 'tendero', 'type' => 'shopkeeper']);
});

$factory->defineAs(User::class, 'producer_default', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['username' => 'productor', 'type' => 'producer']);
});