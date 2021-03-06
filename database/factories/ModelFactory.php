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

use CodeProject\Entities\Client;
use CodeProject\Entities\Project;
use CodeProject\Entities\ProjectMember;
use CodeProject\Entities\ProjectNote;
use CodeProject\Entities\ProjectTask;
use CodeProject\Entities\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(Project::class, function(Faker\Generator $faker){
    return [
        'owner_id' => $faker->numberBetween(1, 10),
        'client_id' => $faker->numberBetween(1, 10),
        'name' => $faker->name,
        'description' => $faker->sentence,
        'progress' => $faker->numberBetween(1, 100),
        'status' => $faker->randomElement(['Não iniciado', 'Iniciado', 'Completo']),
        'due_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});

$factory->define(ProjectNote::class, function(Faker\Generator $faker){
    return [
        'project_id' => rand(1, 10),
        'title' => $faker->word,
        'note' => $faker->paragraph,
    ];
});

$factory->define(ProjectTask::class, function(Faker\Generator $faker){
    return [
        'project_id' => rand(1, 10),
        'name' => $faker->word,
        'status' => rand(1, 3),
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'due_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});

$factory->define(ProjectMember::class, function(Faker\Generator $faker){
    return [
        'project_id' => rand(1, 10),
        'member_id' => rand(1, 11),
    ];
});


