<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Dislike;
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

        
        $likeCount = Like::where('liked_user_id', $likedUserId)->where('liked', true)->count();
        $dislikeCount = Like::where('liked_user_id', $likedUserId)->where('liked', false)->count();

        return response()->json(['liked' => $likeCount, 'disliked' => $dislikeCount]);
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

        $likeCount = Like::where('liked_user_id', $likedUserId)->where('liked', true)->count();
        $dislikeCount = Like::where('liked_user_id', $likedUserId)->where('liked', false)->count();

        return response()->json(['liked' => $likeCount, 'disliked' => $dislikeCount]);
    }

//     public function like(Request $request)
// {
//     $userId = auth()->user()->id;
//     $likedUserId = $request->input('liked_user_id');

//     $like = Like::where('user_id', $userId)
//         ->where('liked_user_id', $likedUserId)
//         ->first();

//     if ($like) {
//         $like->liked = true;
//         $like->save();
//     } else {
//         Like::create([
//             'user_id' => $userId,
//             'liked_user_id' => $likedUserId,
//             'liked' => true,
//         ]);
//     }

//     $likesCount = Like::where('liked_user_id', $likedUserId)
//         ->where('liked', true)
//         ->count();

//     $dislikesCount = Like::where('liked_user_id', $likedUserId)
//         ->where('liked', false)
//         ->count();

//     return response()->json(['message' => 'Liked', 'likesCount' => $likesCount, 'dislikesCount' => $dislikesCount]);
// }

// public function dislike(Request $request)
// {
//     $userId = auth()->user()->id;
//     $likedUserId = $request->input('liked_user_id');

//     $like = Like::where('user_id', $userId)
//         ->where('liked_user_id', $likedUserId)
//         ->first();

//     if ($like) {
//         $like->liked = false;
//         $like->save();
//     } else {
//         Like::create([
//             'user_id' => $userId,
//             'liked_user_id' => $likedUserId,
//             'liked' => false,
//         ]);
//     }

//     $likesCount = Like::where('liked_user_id', $likedUserId)
//         ->where('liked', true)
//         ->count();

//     $dislikesCount = Like::where('liked_user_id', $likedUserId)
//         ->where('liked', false)
//         ->count();

//     return response()->json(['message' => 'Disliked', 'likesCount' => $likesCount, 'dislikesCount' => $dislikesCount]);
// }
}
