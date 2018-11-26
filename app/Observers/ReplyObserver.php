<?php

namespace App\Observers;

use App\Observers\Recorder;

use App\Models\Reply;
use App\Models\User;

use App\Notifications\ArticleReplied;

class ReplyObserver
{
    public function created(Reply $reply)
    {
        $article = $reply->article;
        $article->increment('reply_count', 1);

        // 当回复给自己时不通知的逻辑放在了 Models\User 里，
        // 这样就不需要每一种通知都写一遍 通知的人是否是作者 了
        $article->user->notify(new ArticleReplied($reply));
    }

    public function deleted(Reply $reply)
    {
        $recorder = new Recorder();
        $recorder->recordDeleted($reply, "删除回复");

        $article = $reply->article;
        if ($article->reply_count > 0) {
            $article->decrement('reply_count', 1);
        }
    }
}
