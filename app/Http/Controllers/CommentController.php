<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Services\CommentService;
use App\Models\Post;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['post_id'] = $post->id;
        $this->commentService->createComment($data);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully.');
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->commentService->deleteComment($comment);

        return redirect()->route('posts.show', $post)->with('success', 'Comment deleted successfully.');
    }
}
