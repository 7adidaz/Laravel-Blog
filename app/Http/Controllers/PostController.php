<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $input = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $input['title'] = strip_tags($input['title']);
        $input['description'] = strip_tags($input['description']);
        $input['user_id'] = auth()->user()->id;

        Post::create($input);

        return redirect('/');
    }

    public function editPost(Request $request, Post $post){
        if(auth()->user()->id !== $post->user_id) return redirect('/');
        $input = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $input['title'] = strip_tags($input['title']);
        $input['description'] = strip_tags($input['description']);

        $post->update($input);

        return redirect('/');
    }

    public function editPostView(Post $post){
        if(auth()->user()->id !== $post->user_id) return redirect('/');
        return view('edit-post', ['post' => $post]);
    }

    public function deletePost(Post $post){
        if(auth()->user()->id === $post->user_id) $post->delete();
        return redirect('/');
    }
}
