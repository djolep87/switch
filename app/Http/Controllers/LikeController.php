<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\User;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $userId = auth()->user()->id;
        $likedUserId = $request->input('liked_user_id');

        $like = Like::where('user_id', $userId)
            ->where('liked_user_id', $likedUserId)
            ->first();


        if ($like) {
            $like->liked = true;
            $like->save();
        } else {
            Like::create([
                'user_id' => $userId,
                'liked_user_id' => $likedUserId,
                'liked' => true,
            ]);
        }

        return response()->json(['message' => 'Liked']);
    }

    public function dislike(Request $request)
    {
        $userId = auth()->user()->id;
        $likedUserId = $request->input('liked_user_id');

        $like = Like::where('user_id', $userId)
            ->where('liked_user_id', $likedUserId)
            ->first();

        if ($like) {
            $like->liked = false;
            $like->save();
        } else {
            Like::create([
                'user_id' => $userId,
                'liked_user_id' => $likedUserId,
                'liked' => false,
            ]);
        }

        return response()->json(['message' => 'Disliked']);
    }
}
