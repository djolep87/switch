<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $postsCount = \App\Models\Post::count();
       $posts = \App\Models\Post::all();
       return view('admin.posts.index', compact('posts', 'postsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
         'title'   => 'required|string|max:255',
         'content' => 'required|string',
         'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
     ]);

        // Provera da li je slika postavljena, ako nije, koristi default sliku
       $imageName = 'noimage.jpg';


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();

            $resizedImage = Image::make($image)->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            Storage::disk('public')->put('Posts_images/' . $imgName, (string) $resizedImage->encode());

            $imageName = $imgName;
        }

        // Snimanje posta
        $posts = new \App\Models\Post();
        $posts->title = $request->input('title');
        $posts->content = $request->input('content');
        $posts->image = $imageName;
        $posts->save();

        return back()->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();

            $resizedImage = Image::make($image)->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            Storage::disk('public')->put('Posts_images/' . $imgName, (string) $resizedImage->encode());

            // Obriši staru sliku ako nije default
            if ($post->image !== 'noimage.jpg') {
                Storage::disk('public')->delete('Posts_images/' . $post->image);
            }

            $post->image = $imgName;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Post deleted successfully.');
    }
}
