<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function addComment(Request $request, $product_id)
    {
        $comment_content = $request->comment;
        $this->comment->create([
            'product_id' => $product_id,
            'user_id' => Auth::id(),
            'comment_content' => $comment_content
        ]);
        return redirect()->back();
    }
}
