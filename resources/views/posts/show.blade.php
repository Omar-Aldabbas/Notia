@extends('layouts.app')

@section('title', $post->title . ' — Notia')

@section('content')

<div class="post-page">

    <div class="post-main">
        <div class="post-image">
            @if($post->main_image)
                <img src="{{ asset('storage/' . $post->main_image) }}" alt="{{ $post->title }}">
            @endif
        </div>

        <div class="post-body">
            <h1>{{ $post->title }}</h1>

            <div class="post-meta">
                <div class="author-card">
                    @if($post->author && $post->author->avatar)
                        <img src="{{ asset('storage/' . $post->author->avatar) }}" alt="{{ $post->author->name }}">
                    @else
                        <div class="avatar-placeholder"></div>
                    @endif
                    <div class="author-info">
                        <span class="author-name">{{ $post->author->name ?? 'Unknown' }}</span>
                        <span class="post-date">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="post-stats">
                    <span>{{ $post->views_count ?? 0 }} views</span>
                    @if($post->tag)
                        <span class="post-tag">#{{ $post->tag }}</span>
                    @endif
                </div>
            </div>

            <div class="post-content">
                {!! $post->content !!}
            </div>

            @if($post->sub_images)
                <div class="post-sub-images">
                    @foreach($post->sub_images as $img)
                        <img src="{{ asset('storage/' . $img) }}" alt="Sub image">
                    @endforeach
                </div>
            @endif

            <div class="post-actions">
                <form method="POST" action="{{ route('posts.upvote', $post) }}">
                    @csrf
                    <button type="submit" class="btn">Upvote ({{ $post->upvotes_count ?? 0 }})</button>
                </form>

                <form method="POST" action="{{ route('posts.report', $post) }}">
                    @csrf
                    <button type="submit" class="btn">Report</button>
                </form>

                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="btn">Edit</a>
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Delete</button>
                    </form>
                @endcan
            </div>

        </div>
    </div>

    <div class="post-comments">
        <h2>Comments ({{ $post->comments->count() }})</h2>
        @foreach($post->comments as $comment)
            <div class="comment">
                <span class="comment-author">{{ $comment->user->name ?? 'Unknown' }}</span>
                <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                <p>{{ $comment->content }}</p>
                <form method="POST" action="{{ route('comments.upvote', $comment) }}">
                    @csrf
                    <button type="submit" class="btn">Upvote ({{ $comment->upvotes_count ?? 0 }})</button>
                </form>
                <form method="POST" action="{{ route('comments.report', $comment) }}">
                    @csrf
                    <button type="submit" class="btn">Report</button>
                </form>
                @if($comment->user_id === auth()->id())
                    <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Delete</button>
                    </form>
                @endif
            </div>
        @endforeach

        @auth
            <form method="POST" action="{{ route('comments.store', $post) }}" class="comment-form">
                @csrf
                <textarea name="content" placeholder="Add a comment..."></textarea>
                <button type="submit" class="btn">Submit</button>
            </form>
        @endauth
    </div>

</div>

@endsection
