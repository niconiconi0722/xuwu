<?php

namespace App\Models;

use App\Repositories\RepliesRepository;

class Reply extends Model
{
    protected $fillable = ['content'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLinkAttribute()
    {
        $article = $this->article;

        $repository = new RepliesRepository();
        $page = $repository->getPage($article, $this);

        return url(route('articles.show', $article) . "?page={$page}#reply_{$this->id}");
    }
}
