<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function show()
    {
        return view('invite/invite');
    }
}