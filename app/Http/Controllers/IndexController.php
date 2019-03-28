<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Repositories\EntryRepository;

class IndexController extends Controller
{
    protected $repository;

    public function __construct(EntryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('index');
    }

    public function auth(Request $request)
    {
        if ($request->password === config('app.password')) {
            $this->repository->enter();

            return redirect()->route('announcements.index');
        } else {
            return redirect()->back();
        }
    }
}