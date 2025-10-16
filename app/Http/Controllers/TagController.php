<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = ['music','art','geopolitical','tech','science','travel','food','sports','movies','fashion','education','health','gaming'];
        return view('tags.index', compact('tags'));
    }

    public function show($tag)
    {
        $posts = Post::where('tag', $tag)->latest()->paginate(10);
        return view('tags.show', compact('tag','posts'));
    }
}