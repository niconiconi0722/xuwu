<?php

use Faker\Generator as Faker;
use App\Models\Article;

$factory->define(App\Models\Reply::class, function (Faker $faker) {

    $article = Article::all()->random();

    // 随机取一个月以内的时间
    $time = $faker->dateTimeThisMonth();

    return [
        'article_id' => $article->id,
        'content' => $faker->sentence(),
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
