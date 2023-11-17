<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post   (
     *     path="/api/create/moderator",
     *     summary="Create moderator",
     *     security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="User id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Moderator created successfully"),
     * )
     */

    public function createModerator(Request $request)
    {
        return $this->userService->createModerator($request);
    }

    /**
     * @OA\Post   (
     *     path="/api/block/user",
     *     summary="Block user",
     *     security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="User id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="The user is blocked"),
     * )
     */

    public function blockUser(Request $request)
    {
        return $this->userService->blockUser($request);
    }
}
