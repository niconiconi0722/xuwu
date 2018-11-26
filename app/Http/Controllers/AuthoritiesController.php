<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorityRequest;
use App\Models\User;

class AuthoritiesController extends Controller
{
    public function Update(User $user, AuthorityRequest $request)
    {
        $this->authorize('authorityEdit', $user);

        $user->update([
            'authority' => $request->authority_edit,
        ]);

        return redirect()->back();
    }
}
