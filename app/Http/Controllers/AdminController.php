<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $posts = Post::count();
        $comments = Comment::count();
        $reports = Report::where('status','pending')->count();

        return view('admin.dashboard', compact('users','posts','comments','reports'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success','User deleted');
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return back()->with('success','Post deleted');
    }

    public function comments()
    {
        $comments = Comment::all();
        return view('admin.comments', compact('comments'));
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('success','Comment deleted');
    }

    public function reports()
    {
        $reports = Report::latest()->get();
        return view('admin.reports', compact('reports'));
    }

    public function resolveReport(Report $report)
    {
        $report->update(['status'=>'resolved']);
        return back()->with('success','Report resolved');
    }

    public function dismissReport(Report $report)
    {
        $report->update(['status'=>'dismissed']);
        return back()->with('success','Report dismissed');
    }
}