<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DislikeController extends Controller
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

        // Check if user likes review
        if ($user->likesReview($review)) {
            $user->removeLike($review);
        }

        //Check if user disliked review
        if ($user->dislikesReview($review)) {
            // Remove the dislike from review
            $user->removeDislike($review);
            return back();
        } else {
            // dislike
            $user->dislikes()->attach($id);
            return back();

        }

    }
}
