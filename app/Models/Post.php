<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['user_id','title','description'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function index(){
        $posts=Post::where('user_id',Auth::user()->id)->with('user')->get();
        return $posts;
    }
}
