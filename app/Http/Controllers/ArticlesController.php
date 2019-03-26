<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticlesRepository;

use App\Models\Reply;
use Auth;

use Event;
use App\Events\AtUserEvent;

class ArticlesController extends Controller
{
    protected $repository;

    public function __construct(ArticlesRepository $repository)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $articles = $this->repository->index($request->order);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $replies = $this->repository->show($article);
        return view('articles.show', compact('article', 'replies'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article = $this->repository->store($request, $article);
        Event::fire(new AtUserEvent($article, 'content'));

        return redirect()->route('articles.show', $article->id)->with('success', '创建成功');
    }

    public function destroy(Article $article)
    {
        $this->authorize('destroy', $article);
        $this->repository->destroy($article);

        return redirect()->route('articles.index');
    }
}