<?php
namespace App\Repositories;

use Illuminate\Http\Request;

use App\Notifications\ArticleReplied;
use App\Notifications\AtUser;
use App\Notifications\Announce;

use App\Models\User;
use App\Models\Article;
use App\Models\Reply;

use Auth;

class NotificationsRepository
{
    public function getData($request)
    {
        switch ($request->cate) {
            case 'articlereplied':
                $notifications = $this->getSpecificTypeData(ArticleReplied::class);
                break;

            case 'atuser':
                $notifications = $this->getSpecificTypeData(AtUser::class);
                break;

            case 'announce':
                $notifications = $this->getSpecificTypeData(Announce::class);
                break;

            default:
                $notifications = $this->getAllData();
        }

        return $notifications;
    }

    public function getAllData()
    {
        $notifications = Auth::user()->unreadNotifications()->paginate(22);
        return $notifications;
    }

    public function getSpecificTypeData(string $classname)
    {
        $notifications = Auth::user()->unreadNotifications()->where('type', $classname)->paginate(22);
        return $notifications;
    }

    public function markAsRead($notification)
    {
        switch ($notification->type) {
            case ArticleReplied::class:
            case AtUser::class:
                Auth::user()->markAsRead($notification);
                break;

            case Announce::class:
                // 查看通知后删除数据库里的记录
                Auth::user()->markAsRead($notification, true);
                break;
        }
    }

    public function getLink($notification)
    {
        switch ($notification->type) {
            case ArticleReplied::class:
                $link = $this->getArticleRepliedLink($notification);
                break;

            case AtUser::class:
                $link = $this->getAtUserLink($notification);
                break;

            case Announce::class:
                $link = $this->getAnnounceLink($notification);
                break;
        }

        return $link;
    }

    public function getArticleRepliedLink($notification)
    {
        $reply = Reply::find($notification->data['reply_id']);
        $link = $reply->link;
        return $link;
    }

    public function getAtUserLink($notification)
    {
        $modelType = $notification->data['model_type'];
        $model = $modelType::find($notification->data['model_id']);
        $link = $model->link;

        return $link;
    }

    public function getAnnounceLink($notification)
    {
        $link = route('announcements.show', $notification->data['announcement_id']);
        return $link;
    }
}
