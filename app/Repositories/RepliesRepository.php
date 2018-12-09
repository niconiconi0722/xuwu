<?php

namespace App\Repositories;

use App\Models\Reply;
use Illuminate\Http\Request;

use App\Models\Article;
use Auth;

class RepliesRepository
{
    public function store($request, Article $article, Reply $reply)
    {
        $reply->user_id = Auth::id();
        $reply->article_id = $article->id;
		$reply->content = $request->content;
		$reply->content = str_replace("\n","<br>",$reply->content);
		$reply->content = str_replace(" ","&nbsp;",$reply->content);
        $reply->floor = $article->reply_count + 1;
        $reply->save();

        return [
            'reply' => $reply,
            'article' => $article,
        ];
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();
    }

    public function getPage(Article $article, Reply $reply)
    {
        // 找出当前回复是该贴子的第几条回复
        $row = Reply::where([
            ['article_id', $article->id],
            ['floor', '<=', $reply->floor],
        ])->count();

        $page = (int) ceil($row / 22);

        return $page;
    }
}
