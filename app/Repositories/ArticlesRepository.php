<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Reply;
use Auth;

class ArticlesRepository
{
    public function index($order = 'default')
    {
        $article = new Article();
        $articles = $article->withOrder($order)->paginate(22);
        return $articles;
    }

    public function show($article)
    {
        $replies = $article->replies()->with(['user', 'article'])->paginate(22);
        return $replies;
    }

    public function store($request, Article $article)
    {
        //XSS过滤
        $article->content = clean($request->content, 'user_article_content');
		$article->content = str_replace("\n","<br>",$article->content);
		$article->content = str_replace(" ","&nbsp;",$article->content);
        if (empty($article->content)) {
            return redirect()->back()->withInput()->with('danger', '含有非法内容');
        }

        $article->title = $request->title;
        $article->user_id = Auth::id();
        $article->save();

        return $article;
    }

    public function destroy($article)
    {
        $article->delete();
    }
}
