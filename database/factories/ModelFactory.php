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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('ru_RU');
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'type'=> $faker->randomElement($array = array ('admin','manager','user')),
    ];
});
$factory->define(App\Models\Auto::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('ru_RU');
    return [
        'user_id' => rand(1,10),
        'mark_id' => 1,
        'model_id' => rand(1,5),
        'number'=> str_random(10),
        'year'=> $faker->year,
        'date_kont'=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'date_rem'=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'rem_kil'=> rand(50000,100000),
        'devices'=> false,
        'comments'=> $faker->text(),
    ];
});
$factory->define(App\Models\Device::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('ru_RU');
    return [
        'user_id' => rand(1,10),
        'category' => $faker->randomElement($array = array ('Кузов','Двигатель','Ходовая')),
        'mark_id' => 1,
        'model_id' => rand(1,5),
        'version'=> rand(1,5),
        'year'=> $faker->year,
        'date_kont'=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'date_rem'=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'rem_time'=> time()+3600*rand(100,500),
        'comments'=> $faker->text(),
    ];
});


$factory->define(App\Models\Zapros::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('ru_RU');
    return [
        'user_id' => rand(1,10),
        'object' => str_random(10),
        'zadanie' => str_random(10),
        'description'=>$faker->text(),
        'comments_tehnics'=>$faker->sentence($nbWords = 15, $variableNbWords = true),
        'done' => rand(0,2),
    ];
});