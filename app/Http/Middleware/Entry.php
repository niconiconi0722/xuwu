<?php

namespace App\Http\Middleware;

use App\Repositories\EntryRepository;
use Closure;

class Entry
{
    protected $except = [];

    public function __construct()
    {
        array_push(
            $this->except,
            route('index'),
            route('invite.show'),
            route('invite.alias')
        );
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((new entryRepository())->isEntered()) {
            if ($request->path() == '/') {
                return redirect()->route('announcements.index');
            }
            return $next($request);
        } elseif ($this->isInExcept($request)) {
            return $next($request);
        } else {
            return redirect()->route('index');
        }
    }

    protected function isInExcept($request)
    {
        return in_array($request->url(), $this->except);
    }
}
