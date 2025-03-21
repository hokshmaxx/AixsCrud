<?php

namespace App\Domains\Posts\Services;

use App\Domains\Posts\DTOs\PostDTO;
use App\Domains\Posts\Repositories\PostRepository;

class PostService {
    protected $postRepository;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts() {
        return $this->postRepository->getAll();
    }

    public function createPost(PostDTO $postDTO) {
        return $this->postRepository->create((array) $postDTO);
    }

    public function updatePost($id, PostDTO $postDTO) {
        return $this->postRepository->update($id, (array) $postDTO);
    }

    public function deletePost($id) {
        return $this->postRepository->delete($id);
    }
}
