<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();

        return BlogResource::collection($blogs);
        
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
            'title'=>'required',
            'body'=>'required',
            'author'=>'string'
        ]);

        $blog = Blog::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'author'=>$request->author,
        ]);

        return new BlogResource($blog);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
       return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Blog $blog, Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'author'=>'required'
        ]);

        $blog->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'author'=>$request->author,
        ]);

        return new BlogResource($blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return new BlogResource([
            'blog'=>$blog,
            'message'=>"blog deleted",
            'status_code'=>200
        ]);
    }
}
