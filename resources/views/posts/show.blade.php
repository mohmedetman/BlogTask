{{-- resources/views/posts/show.blade.php --}}
@extends('adminlte::page')

@section('title', $post->title)

@section('content_header')
    <h1>{{ $post->title }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <p><small>Created at: {{ $post->created_at->format('Y-m-d H:i') }}</small></p>

                <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                <hr>
                <h5>Comments:</h5>
                @forelse($post->comments as $comment)
                    <div class="mb-2">
                        <p>{{ $comment->comment_content }}</p>
                        <form action="{{ route('comments.destroy', [$post, $comment]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete Comment</button>
                        </form>
                    </div>
                @empty
                    <p>No comments for this post yet.</p>
                @endforelse
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment_content">Add Comment:</label>
                        <textarea name="comment_content" class="form-control" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Add Comment</button>
                </form>
            </div>
        </div>
    </div>
@stop