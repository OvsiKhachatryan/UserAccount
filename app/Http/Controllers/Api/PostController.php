<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @OA\Get(
     *     path="/api/{locale}/get/posts",
     *     summary="Get post",
     *     security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\Parameter(
     *         name="locale",
     *         in="path",
     *         description="locale",
     *         required=true,
     *         @OA\Schema(type="string")
     *      ),
     *     @OA\Response(response="201", description="Posts list"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */

    public function get($locale)
    {
        return $this->postService->get($locale);
    }

    /**
     * @OA\Post(
     *     path="/api/create/post",
     *     summary="Create post",
     *     security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\Parameter(
     *         name="name_am",
     *         in="query",
     *         description="name_am",
     *         required=true,
     *         @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *         name="name_en",
     *         in="query",
     *         description="name_en",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="name_ru",
     *         in="query",
     *         description="name_ru",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="description_am",
     *         in="query",
     *         description="description_am",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="description_en",
     *         in="query",
     *         description="description_en",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description_ru",
     *         in="query",
     *         description="description_ru",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="image",
     *                     type="file",
     *                ),
     *                 required={"image"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="201", description="Post created successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */

    public function create(Request $request)
    {
        return $this->postService->create($request);
    }

    /**
     * @OA\Post(
     *     path="/api/update/post",
     *     summary="Update post",
     *     security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\Parameter(
     *         name="post_id",
     *         in="query",
     *         description="post_id",
     *         required=false,
     *         @OA\Schema(type="integer")
     *      ),
     *     @OA\Parameter(
     *         name="name_am",
     *         in="query",
     *         description="name_am",
     *         required=false,
     *         @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *         name="name_en",
     *         in="query",
     *         description="name_en",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="name_ru",
     *         in="query",
     *         description="name_ru",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="image",
     *                     type="file",
     *                ),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="201", description="Post updated successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */

    public function update(Request $request)
    {
        return $this->postService->update($request);
    }

    /**
     * @OA\Post(
     *     path="/api/delete/post",
     *     summary="Delete post",
     *     security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\Parameter(
     *         name="post_id",
     *         in="query",
     *         description="post_id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="201", description="Post deleted successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */

    public function delete(Request $request)
    {
        return $this->postService->delete($request);
    }
}
