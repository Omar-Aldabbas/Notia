<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $featuredPost = Post::latest()->first();

        $popularPosts = Post::orderBy('views_count', 'desc')->take(3)->get();

        $recentPosts = Post::latest()->take(6)->get();

        $topAuthors = User::withCount('posts')
            ->withSum('posts', 'views_count')
            ->orderByDesc('posts_sum_views_count')
            ->take(6)
            ->get();

        return view('posts.index', compact(
            'featuredPost',
            'popularPosts',
            'recentPosts',
            'topAuthors'
        ));
    }

    public function magazine()
    {
        $posts = Post::latest()->paginate(12);
        return view('posts.magazine', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'main_image' => 'nullable|image',
            'sub_images.*' => 'nullable|image',
            'tag' => 'nullable|string',
        ]);

        $post = new Post($data);
        $post->author_id = Auth::id();
        $post->save();

        return redirect()->route('posts.show', $post)->with('success','Post created');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'main_image' => 'nullable|image',
            'sub_images.*' => 'nullable|image',
            'tag' => 'nullable|string',
        ]);

        $post->update($data);

        return redirect()->route('posts.show', $post)->with('success','Post updated');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('home')->with('success','Post deleted');
    }
}