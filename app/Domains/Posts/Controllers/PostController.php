<?php

namespace App\Domains\Posts\Controllers;
use App\Http\Controllers\Controller;
use App\Domains\Posts\Services\PostService;
use App\Domains\Posts\DTOs\PostDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller {
    protected $postService;

    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }

    //  all posts
    public function index() {
        return response()->json($this->postService->getAllPosts(), Response::HTTP_OK);
    }

    //  new post
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $postDTO = new PostDTO($validated);
        $post = $this->postService->createPost($postDTO);

        return response()->json($post, Response::HTTP_CREATED);
    }

    //  Get  post by ID
    public function show($id) {
        try {
            $post = $this->postService->getAllPosts()->find($id);
            if (!$post) {
                return response()->json(['message' => 'Post not found'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($post, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //  Update a post
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $postDTO = new PostDTO($validated);
        $post = $this->postService->updatePost($id, $postDTO);

        return response()->json($post, Response::HTTP_OK);
    }

    // ✅ Delete a post
    public function destroy($id) {
        $this->postService->deletePost($id);
        return response()->json(['message' => 'Post deleted successfully'], Response::HTTP_OK);
    }
}
