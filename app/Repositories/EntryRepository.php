<?php

namespace App\Repositories;

use Session;

class EntryRepository
{
    protected $sessionName = 'entry';

    public function enter()
    {
        Session::put($this->sessionName, true);
        Session::save();
    }

    public function isEntered()
    {
        return Session::has($this->sessionName) && (Session::get($this->sessionName) === true);
    }

    public function exit()
    {
        Session::remove($this->sessionName);
        Session::save();
    }
}
