<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostService
{
    public function get($locale)
    {
        $posts = Post::select(['id', 'user_id', 'name_' . $locale, 'description_' . $locale, 'image'])->get();

        return response()->json($posts, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_am' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
            'description_am' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->name_am = $request->name_am;
        $post->name_en = $request->name_en;
        $post->name_ru = $request->name_ru;
        $post->description_am = $request->description_am;
        $post->description_en = $request->description_en;
        $post->description_ru = $request->description_ru;

        $file = $request->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extenstion;
        $file->storeAs('public/images/posts', $filename);
        $post->image = $filename;

        $post->save();

        return response()->json('Post created successfully');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $post = Post::where('user_id', '=', Auth::user()->id)
            ->where('id', '=', $request->post_id)
            ->first();

        $imageName = '';
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images/posts/', $imageName);
            if ($post->image) {
                Storage::delete('public/images/posts/' . $post->image);
            }
        } else {
            $imageName = $post->image;
        }

        $postData = [
            'name_am' => $request->name_am,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'image' => $imageName
        ];

        $post->update($postData);

        return response()->json('Post updated successfully');
    }

    public function delete(Request $request)
    {
        Post::find($request->post_id)->delete();

        return response()->json('Post deleted successfully');
    }
}
