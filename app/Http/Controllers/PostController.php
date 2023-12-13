<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts()
    {
        $posts = Post::with('user') -> orderBy('created_at', 'desc') -> get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function writePost()
    {
        return view('posts.write');
    }

    public function createPost(Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $user_id = auth()->user()->id;
        
        $postData = [
            'user_id' => $user_id,
            'title' => $request->title,
            'content' => $request->content,
        ];

        Post::create($postData);

        return redirect('/');
    }

    public function getPost($id)
    {
        $post = Post::with('user', 'comments') -> find($id);
        return view('posts.detail', ['post' => $post]);
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post -> delete();
        return redirect('/');
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function updatePost(Request $request, $id)
    {
        $request -> validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::find($id);
        $post -> title = $request -> title;
        $post -> content = $request -> content;
        $post -> save();

        return redirect('/posts/'.$id);
    }
}
