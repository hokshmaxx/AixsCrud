<?php

namespace App\Livewire;

use App\Domains\Posts\DTOs\PostDTO;
use App\Domains\Posts\Models\Post;
use App\Domains\Posts\Services\PostService;
use Livewire\Component;

class PostCrud extends Component
{
    public $posts =[];
    public $title, $content, $postId;
    public $isOpen = false;
    protected $postService;

    protected $listeners = ['confirmDelete' => 'deletePost', 'refreshComponent' => '$refresh'];

    public function __construct()
    {
        $this->postService = app(PostService::class);
    }

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        // Refresh  posts list

        $this->posts = $this->postService->getAllPosts();

        info("Loaded Posts: " . json_encode($this->posts->toArray())); // Log posts data

    }

    public function render()
    {
        return view('livewire.post-crud');
    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        info("Editing Post: " . json_encode($id));
        info("Current Posts: " . json_encode($this->posts));

        // Find the post within the loaded collection
        $post = collect($this->posts)->firstWhere('id', $id);

        if ($post) {
            $this->postId = $id;
            $this->title = $post['title'];
            $this->content = $post['content'];
            $this->isOpen = true;
        } else {
            //  reset the form
            $this->resetFields();
        }
    }
    public function save()
    {
        // Validate
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Create or update the post
        $postDTO = new PostDTO([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        if ($this->postId) {
            $this->postService->updatePost($this->postId, $postDTO);
        } else {
            $this->postService->createPost($postDTO);
        }

        // Refresh the posts list and reset the form
        $this->loadPosts();
        $this->resetFields();
    }

    public function deletePost($postId)
    {
        // Delete the post
        $this->postService->deletePost($postId);

        // If the deleted post was being edited, close the modal and reset the form
        if ($this->postId == $postId) {
            $this->resetFields();
        }

        // Refresh the list

        $this->loadPosts();
//        $this->dispatch('refreshComponent');

    }

    private function resetFields()
    {
        // Reset form fields and state
        $this->postId = null;
        $this->title = '';
        $this->content = '';
        $this->isOpen = false;
    }
}
