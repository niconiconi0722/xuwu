<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Repositories\AnnouncementsRepository;

use Event;
use App\Events\AnnouncementEvent;

class AnnouncementsController extends Controller
{
    protected $repository;

    public function __construct(AnnouncementsRepository $repository)
    {
        $this->middleware('auth', ['except' => ['index']]);

        $this->repository = $repository;
    }

    public function index()
    {
        $announcements = $this->repository->index();

        return view('announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function create()
    {
        $this->authorize('save', Announcement::class);

        return view('announcements.create');
    }

    public function store(AnnouncementRequest $request, Announcement $announcement)
    {
        $this->authorize('save', $announcement);
        if ($this->repository->isChangingPriority($request)) {
            $this->authorize('changePriority', $announcement);
        }

        $announcement = $this->repository->save($request, $announcement);
        Event::fire(new AnnouncementEvent($announcement));
        // Event::fire(new AtUserEvent($announcement, 'content'));

        return redirect()->route('announcements.show', $announcement->id)->with('success', '创建成功');
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        $this->authorize('save', $announcement);
        if ($this->repository->isChangingPriority($request, $announcement)) {
            $this->authorize('changePriority', $announcement);
        }

        $this->repository->save($request, $announcement);

        return redirect()->route('announcements.show', $announcement);
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorize('destroy', $announcement);
        $this->repository->destroy($announcement);

        return redirect()->route('announcements.index');
    }
}