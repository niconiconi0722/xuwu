<?php

namespace App\Repositories;

use App\Models\Announcement;
use Auth;

class AnnouncementsRepository
{
    const PRIORITY_DEFAULT = 0;

    public function index()
    {
        $announcements = Announcement::orderBy('priority', 'desc')
                                       ->orderBy('updated_at', 'desc')
                                       ->paginate(22);
        return $announcements;
    }

    public function isChangingPriority($request, Announcement $originalAnnouncement = null)
    {
        if (! isset($request->priority)) {
            return false;
        }

        if ($originalAnnouncement) {
            return $request->priority != $originalAnnouncement->priority;
        }

        return $request->priority != self::PRIORITY_DEFAULT;
    }

    public function save($request, Announcement $announcement)
    {
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->user_id = Auth::id();
        if (isset($request->priority)) {
            $announcement->priority = $request->priority;
        }

        $announcement->save();

        return $announcement;
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
    }
}
