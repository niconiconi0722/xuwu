<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\UsersController;
use App\Models\User;
use App\Models\Article;

class UserTest extends TestCase
{
    /**
     * @dataProvider userAndArticleProvider
     */
    public function testIsAuthorOf(User $user, Article $article, bool $isAuthor)
    {
        $this->assertEquals($isAuthor, $user->isAuthorOf($article));
    }

    public function userAndArticleProvider()
    {
        $user = new User();
        $user->id = 1;

        $article1 = new Article();
        $article1->id = 1;
        $article1->user_id = 2;

        $article2 = new Article();
        $article2->id = 2;
        $article2->user_id = 1;

        return [
            "differentAuthor" => [$user, $article1, false],
            "sameAuthor" => [$user, $article2, true],
        ];
    }
}
