<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    public function store(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $user = Auth::user();

        // Check if user dislikes review
        if ($user->dislikesReview($review)) {
            $user->removeDislike($review);
        }

        //Check if user liked review
        if ($user->likesReview($review)) {
            // Remove the like from review
            $user->removeLike($review);
            return back();
        } else {
            // like
            $user->likes()->attach($id);
            return back();

        }

    }
}
