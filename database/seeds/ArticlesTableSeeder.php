<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);

        $articles = factory(Article::class)
                            ->times(100)
                            ->make()
                            ->each(function ($article, $index)
                                use ($user_ids, $faker)
                                {
                                    $article->user_id = $faker->randomElement($user_ids);
                                });

        Article::insert($articles->toArray());
    }
}
