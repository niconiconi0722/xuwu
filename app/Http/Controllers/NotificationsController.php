<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NotificationsRepository;

use App\Notifications\ArticleReplied;
use App\Notifications\AtUser;
use App\Notifications\Announce;

use App\Models\User;
use App\Models\Article;
use App\Models\Reply;

use Illuminate\Notifications\DatabaseNotification as Notification;
use Auth;

class NotificationsController extends Controller
{
    protected $repository;

    public function __construct(NotificationsRepository $repository)
    {
        $this->middleware('auth');

        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $notifications = $this->repository->getData($request);

        return view('notifications.index', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        $this->repository->markAsRead($notification);
        $link = $this->repository->getLink($notification);

        return redirect($link);
    }
}
