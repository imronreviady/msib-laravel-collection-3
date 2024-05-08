<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    // crud
    // create
    // read (done)
    // update
    // delete
    // filter
    // search


    public function index() {
        // $posts = Post::paginate();
        // $posts = Post::all();
        // $posts = Post::get();
        $posts = Post::latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        // $request->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        // ]);

        // // Post::create([
        // //     'title' => $request->title,
        // //     'content' => $request->content,
        // // ]);

        // $post = new Post();
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->save();

        $user = User::find(1);

        $post = new Post();
        $post->title = 'Judul Postingan 1';
        $post->content = 'Isi Postingan 1';
        $post->user_id = $user->id;
        $post->save();

        // Menambahkan postingan ke beberapa kategori
        $categories = Category::whereIn('id', [1, 2, 3])->get();

        $post->categories()->attach($categories);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');

    }

    public function ajaxCreate(PostCreateRequest $request) {
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = $request->user_id;
            $post->save();

            // Mencatat kegiatan pembuatan postingan
            Log::info("Postingan baru dibuat oleh User ID {$request->user_id}: {$post->title}");

            return response()->json([
                'message' => 'Post created successfully',
                'data' => $post,
            ]);
        } catch (\Exception $e) {
            // mencatat kesalahan jika terjadi
            Log::error("Terjadi kesalahan saat membuat postingan: {$e->getMessage()}");
            
            return response()->json([
                'message' => 'Post failed to create',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id) {
        $post = Post::find($id);

        $images = $post->image;

        dd($images);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // $post = Post::find($id);
        // $post = Post::where('id', $id)->first();
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->save();

        Post::where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function delete(Request $request, $id) {
        $post = Post::find($id);

        $post->categories()->detach();

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
