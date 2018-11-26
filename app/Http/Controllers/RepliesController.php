<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Repositories\RepliesRepository;

use App\Models\Article;
use Auth;

use Event;
use App\Events\AtUserEvent;

class RepliesController extends Controller
{
    protected $repository;

    public function __construct(RepliesRepository $repository)
    {
        $this->middleware('auth');

        $this->repository = $repository;
    }

	public function create(Article $article)
	{
		return view('replies.create', compact('article'));
	}

	public function store(ReplyRequest $request, Article $article, Reply $reply)
	{
        $returned = $this->repository->store($request, $article, $reply);
        Event::fire(new AtUserEvent($reply, 'content'));

        return redirect()->route('articles.replies.show', [$article, $reply]);
	}

    public function show(Article $article, Reply $reply)
    {
        return redirect($reply->link);
    }

	public function destroy(Article $article, Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$this->repository->destroy($reply);

		return redirect()->back()->with('message', '成功删除');
	}
}
