<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\CommentCreated;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->insert([
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id
        ]);
        $users = User::all();
        $comment_status = 'New Comment';
        $comment_id = $comment->id;
        $product = Product::findOrFail($request->product_id);
        foreach ($users as $user) {
            if ($user->id !== Auth::user()->id) {
                $user->notify(new CommentCreated(Auth::user(), $comment_id, $comment_status, $request->comment, $product->name));
            }
        }
    }
    public function getComments(Product $product)
    {
        return response()->json($product->comments()->with('user')->latest()->get());
    }
    public function unreadNotifications()
    {
        $unreadNotifications=Auth::user()->unreadNotifications;
        return response()->json($unreadNotifications);
    }
}
