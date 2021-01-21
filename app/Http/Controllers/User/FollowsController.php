<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class FollowsController extends Controller
{
    // Follow users
    public function store($id)
    {
        $user = User::find($id);

        // Auth user Follow the user
        Auth::user()->toggleFollow($user);

        return back();
    }
}
