<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\BlockUser;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function createModerator(Request $request)
    {
        User::where('id', '=', $request->user_id)->update(['role' => 2]);

        return response()->json('Moderator created successfully');
    }

    public function blockUser(Request $request)
    {
        User::where('id', '=', $request->user_id)->update(['status' => 1]);
        $user = User::find($request->user_id);

        $user->notify(new BlockUser($user));

        return response()->json('The user is blocked');
    }
}
