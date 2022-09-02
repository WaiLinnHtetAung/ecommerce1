<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\Post;
use App\Notifications\PostLikeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return response()->json([
            'data' => $posts,
            'user' => Auth::user(),
            'user_notification' => Auth::user()->notifications,
            'message' => 'Success',
            'status' => 'success',
            'status_code' => 200
        ], 200);
    }
    public function postLike(Request $request)
    {
        $user = auth()->user();
        $post = Post::whereId($request->post_id)->with('user')->first();
        //like code ---skip
        $author = $post->user;
        if ($author) {

            $author->notify(new PostLikeNotification($user, $post));
        }
        return response()->json(['message' => 'success']);
    }
}
