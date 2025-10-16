<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'author');

        if ($request->has('sort') && $request->sort === 'active') {
            $query->withCount('posts')->orderByDesc('posts_count');
        } else {
            $query->orderBy('name');
        }

        $authors = $query->paginate(12);

        return view('authors.index', compact('authors'));
    }

    public function show(User $user)
    {
        if ($user->role !== 'author') {
            abort(404);
        }

        $posts = $user->posts()->withCount(['comments','postsUpvotes'])->paginate(10);

        $stats = [
            'total_posts' => $user->posts()->count(),
            'total_views' => $user->posts()->sum('views'),
            'total_upvotes' => $user->postsUpvotes()->count(),
            'total_comments' => $user->comments()->count(),
        ];

        return view('authors.show', compact('user','posts','stats'));
    }

    public function mostViewed()
    {
        $authors = User::where('role', 'author')
            ->withCount('posts')
            ->withSum('posts as total_views','views')
            ->orderByDesc('total_views')
            ->take(10)
            ->get();

        return view('authors.mostViewed', compact('authors'));
    }
}