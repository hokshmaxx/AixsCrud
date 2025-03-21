<?php

namespace App\Domains\Posts\DTOs;

class PostDTO {
    public string $title;
    public string $content;

    public function __construct(array $data) {
        $this->title = $data['title'];
        $this->content = $data['content'];
    }

}
