<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @OA\Post(
     *     path="/api/create/comment",
     *     summary="Create comment",
     *     security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\Parameter(
     *         name="post_id",
     *         in="query",
     *         description="Post id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *      ),
     *     @OA\Parameter(
     *         name="reply_comment_id",
     *         in="query",
     *         description="Reply comment id",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="comment_am",
     *         in="query",
     *         description="Comment_am",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="comment_en",
     *         in="query",
     *         description="Comment_en",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="comment_ru",
     *         in="query",
     *         description="Comment_ru",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="Comment created successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */

    public function create(Request $request)
    {
        return $this->commentService->create($request);
    }

    /**
     * @OA\Post   (
     *     path="/api/delete/comment",
     *     summary="Delete comment",
     *     security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\Parameter(
     *         name="comment_id",
     *         in="query",
     *         description="Comment id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Comment deleted successfully"),
     * )
     */

    public function delete(Request $request)
    {
        return $this->commentService->delete($request);
    }
}
