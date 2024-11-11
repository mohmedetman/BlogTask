<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function getAllPosts()
    {
        return $this->post->with('comments')->get();
    }

    public function createPost($data)
    {
        return $this->post->create($data);
    }

    public function updatePost(Post $post, $data)
    {
        return $post->update($data);
    }

    public function deletePost(Post $post)
    {
        return $post->delete();
    }
}
