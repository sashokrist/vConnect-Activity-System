<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'slug' => $faker->word(),// Random task title
        'body' => $faker->text(300),
        'filename' => 'no files attached',
        'category_id' => $faker->numberBetween(1,3),
        'created_at' => $faker->dateTimeBetween('-30 days', '+30 days'),
        'group_id' => $faker->numberBetween(1,4),
        'image' => '["image.jpg"]'
    ];
});
