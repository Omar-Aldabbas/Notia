@extends('layouts.app')

@section('title', 'Notia — Art & Life')

@section('content')

<div class="home-header">
    <h1>NOTIA</h1>
    <p>Stories  Ideas  Insights   ART  Life  Authintic  Thinking  Creative </p>
</div>

<div class="intro-section">
    <div class="intro-left">
        DON'T CLOSE YOUR EYES
    </div>
    <div class="intro-right">
        Notia is a platform where creativity meets expression. Explore stories, ideas, and insights shared by authors across diverse fields. Our minimalist brutalist design emphasizes the content — raw, bold, and unforgettable. Dive in, explore, and experience Art & Life like never before.
    </div>
</div>

<div class="home-main">
    <div class="featured-post">
        @if(isset($featuredPost) && $featuredPost)
            @if($featuredPost->main_image)
                <img src="{{ asset('storage/' . $featuredPost->main_image) }}" alt="{{ $featuredPost->title }}">
            @else
                <div class="no-image">No Image</div>
            @endif
            <div class="featured-content">
                <h2>{{ $featuredPost->title }}</h2>
                <p>{{ Str::limit(strip_tags($featuredPost->content), 150) }}</p>
                <div class="meta">
                    <span>{{ $featuredPost->author->name ?? 'Unknown' }}</span>
                    <span>{{ $featuredPost->created_at->diffForHumans() }}</span>
                </div>
                <a href="{{ route('posts.show', $featuredPost) }}" class="btn">Read More</a>
            </div>
        @else
            <div class="no-featured">Welcome to Notia! Stay tuned for bold and unforgettable stories.</div>
        @endif
    </div>

    <div class="sidebar">
        <div class="popular-articles">
            <h3>Top 3 Popular Articles</h3>
            @if(isset($popularPosts) && $popularPosts->count())
                @foreach($popularPosts as $post)
                    <a href="{{ route('posts.show', $post) }}">{{ Str::limit($post->title, 40) }}</a>
                @endforeach
            @else
                <p>No popular articles yet.</p>
            @endif
        </div>
        <div class="ad-box">
            Inspire, Create, Share
        </div>
    </div>
</div>

<div class="recent-articles">
    <h3>Recent Articles</h3>
    <div class="articles-grid">
        @if(isset($recentPosts) && $recentPosts->count())
            @foreach($recentPosts as $post)
                <a href="{{ route('posts.show', $post) }}" class="article-card">
                    @if($post->main_image)
                        <img src="{{ asset('storage/' . $post->main_image) }}" alt="{{ $post->title }}">
                    @else
                        <div class="no-image">No Image</div>
                    @endif
                    <div class="article-content">
                        <h4>{{ Str::limit($post->title, 50) }}</h4>
                        <p>{{ Str::limit(strip_tags($post->content), 70) }}</p>
                        <div class="meta">
                            <span>{{ $post->author->name ?? 'Unknown' }}</span>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        @if($post->tag)
                            <span class="tag">#{{ $post->tag }}</span>
                        @endif
                    </div>
                </a>
            @endforeach
        @else
            <p>No recent articles yet.</p>
        @endif
    </div>
</div>

<div class="podcast-section">
    <h3>Podcast</h3>
    <div class="podcast-grid">
        @for($i = 1; $i <= 3; $i++)
            <div class="podcast-card">
                <div class="podcast-image">Podcast Image {{ $i }}</div>
                <h4>Podcast Episode {{ $i }}</h4>
                <p>Short description for podcast episode {{ $i }}</p>
                <a href="#" class="btn">Listen Now</a>
            </div>
        @endfor
    </div>
</div>

<div class="top-authors">
    <h3>Top Authors</h3>
    <div class="authors-grid">
        @if(isset($topAuthors) && $topAuthors->count())
            @foreach($topAuthors as $author)
                <a href="{{ route('authors.show', $author) }}" class="author-card">
                    @if($author->avatar)
                        <img src="{{ asset('storage/' . $author->avatar) }}">
                    @else
                        <div class="avatar-placeholder"></div>
                    @endif
                    <h4>{{ $author->name }}</h4>
                    <p>Posts: {{ $author->posts_count ?? 0 }} | Views: {{ $author->posts_sum_views_count ?? 0 }}</p>
                </a>
            @endforeach
        @else
            <p>No authors yet.</p>
        @endif
    </div>
</div>

@endsection
