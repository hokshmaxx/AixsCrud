<?php

namespace App\Domains\Posts\Repositories;

use App\Domains\Posts\Models\Post;

class PostRepository {
    public function getAll() {
        return Post::all();
    }

    public function findById($id) {
        return Post::findOrFail($id);
    }

    public function create(array $data) {
        return Post::create($data);
    }

    public function update($id, array $data) {
        $post = $this->findById($id);
        $post->update($data);
        return $post;
    }

    public function delete($id) {
        return Post::destroy($id);
    }
}
