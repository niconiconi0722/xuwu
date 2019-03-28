<?php

namespace App\Repositories;

use Session;

class LoginAttemptCountRepository
{
    protected $sessionName = 'login_attempt_count';
    protected $limit = 5;

    public function getCount()
    {
        return Session::get($this->sessionName);
    }

    public function addCount()
    {
        Session::put($this->sessionName, $this->getCount()+1);
        //Session::save();
    }

    public function shouldCaptcha()
    {
        return $this->getCount() >= $this->limit;
    }

    public function resetCount()
    {
        Session::put($this->sessionName, 0);
    }
}