<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentService
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|numeric',
            'comment_am' => 'required',
            'comment_en' => 'required',
            'comment_ru' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->reply_comment_id = $request->reply_comment_id;
        $comment->comment_am = $request->comment_am;
        $comment->comment_en = $request->comment_en;
        $comment->comment_ru = $request->comment_ru;
        $comment->save();

        return response()->json('Comment created successfully');
    }

    public function delete(Request $request)
    {
        Comment::find($request->comment_id)->delete();

        return response()->json('Comment deleted successfully');
    }
}
