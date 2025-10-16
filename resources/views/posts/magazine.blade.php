@extends('layouts.app')

@section('title', 'Notia — Magazine')

@section('content')

<div class="magazine-header">
    <h1>MAGAZINE</h1>
</div>

<div class="posts-grid">
    @if(isset($posts) && $posts->count())
        @foreach($posts as $post)
            <a href="{{ route('posts.show', $post) }}" class="post-card">
                @if($post->main_image)
                    <img src="{{ asset('storage/' . $post->main_image) }}" alt="{{ $post->title }}">
                @endif
                <div class="post-content">
                    <h2>{{ Str::limit($post->title, 50) }}</h2>
                    <p>{{ Str::limit(strip_tags($post->content), 80) }}</p>
                    <div class="post-meta">
                        <span>{{ $post->author->name ?? 'Unknown' }}</span>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                        <span>{{ $post->views_count ?? 0 }} views</span>
                    </div>
                    @if($post->tag)
                        <span class="post-tag">#{{ $post->tag }}</span>
                    @endif
                </div>
            </a>
        @endforeach
    @else
        <p>No posts available.</p>
    @endif
</div>

<div class="pagination">
    {{ $posts->links() }}
</div>

@endsection
