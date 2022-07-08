<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Validator;

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
     $validator = Validator::make($request->all(),[
        'title'=>'required',
        'body'=>'required',
        'author'=>'required'
     ]);

     if($validator->fails()){
        return response()->json(['status_code'=>500,'message'=>'bad request']);
     }
           

        $blog = Blog::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'author'=>$request->author,
        ]);

        return new BlogResource([$blog,'message'=>'Blog created successfully']);
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
      $blog->update($request->all());

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

        return new BlogResource($blog);
    }
}
