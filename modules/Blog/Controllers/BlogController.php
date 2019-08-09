<?php

namespace Modules\Blog\Controllers;

use Auth;
use App\User;
use Modules\Blog\Models\Post;
use Modules\Blog\DataTables\BlogDataTable;
use Modules\Store\Models\Category;
use Illuminate\Http\Request;

/**
 * Handle blog requests
 * @package Modules\Blog
 */
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog::index', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create empty post
        $post = new Post();
        $post->guid();

        // Redirect to edit page here
        return redirect()->route('post.edit', $post->id);
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
            'type'      => ['required', 'string', 'max:20'],
            'title'     => ['required', 'string', 'max:255'],
            'summary'   => ['required', 'string', 'max:1024'],
        ]);

        $post = new Post();
        $post->fill($request->all($post->getFillable()));
        $post->status = Post::STATUS_DRAFT;
        $post->save();

        return redirect()->route('post.edit', $post->id)->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('blog::show', [
            'post' => $post,
            'dataset' => Post::getDataset()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $post = Post::find($post) ?? new Post(['_id' => $post]);

        return view('blog::edit', [
            'post' => $post,
            'cates' => Category::all(),
            'dataset' => Post::getDataset()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'pid'       => ['nullable', 'int'],
            'title'     => ['required', 'string', 'max:255'],
            'slug'      => ['nullable', 'string', 'max:255'],
            'thumb'     => ['nullable', 'string', 'max:255'],
            'summary'   => ['required', 'string', 'max:1024'],
            'products'  => ['nullable', 'array'],
            'cates'     => ['nullable', 'array'],
            'tags'      => ['nullable', 'array'],
            'meta'      => ['nullable', 'array'],
            'status'    => ['required', 'int', 'between:0,1'],
        ]);

        $post->fill($request->only($post->getFillable()));
        $post->save();

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $blog)
    {
        $blog->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully');
    }

    /**
     * Datatable ajax request
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(BlogDataTable $datatable)
    {
        return $datatable->build()->toJson();
    }
}