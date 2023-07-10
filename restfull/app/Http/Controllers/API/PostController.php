<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::latest()->paginate(10);
    return PostResource::collection($posts);
  }

  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'title' => 'required|min:8',
      'category' => 'required|min:6',
      'status' => 'required',
      'description' => 'required|min:50'
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 400);
    }

    $post = Post::create([
      'title' => $request->title,
      'slug' => Str::slug($request->title),
      'category' => $request->category,
      'status' => $request->status,
      'description' => $request->description
    ]);

    return response()->json([
      'message' => 'Post Created Successfully',
      'data' => $post
    ], 200);
  }

  public function show($slug)
  {
    $post = Post::where('slug', $slug)->first();
    return response()->json($post);
  }

  public function update(Request $request, $slug)
  {

    $validator = Validator::make($request->all(), [
      'title' => 'required|min:8',
      'category' => 'required|min:6',
      'status' => 'required',
      'description' => 'required|min:50'
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 400);
    }

    $post = Post::where('slug', $slug)->first();
    if(!$post){
      return response()->json(['error' => 'Post not found'], 404);
    }

    $post->update([
      'title' => $request->title,
      'slug' => Str::slug($request->title),
      'category' => $request->category,
      'status' => $request->status,
      'description' => $request->description
    ]);

    return response()->json([
      'message' => 'Post Updated Successfully',
      'data' => $post
    ], 200);
  }

  public function destroy($slug)
  {
    $post = Post::where('slug', $slug)->first();
    if(!$post){
      return response()->json(['error' => 'Post not found'], 404);
    }
    $post->delete();
    return response()->json([
      'message' => 'Post Deleted Successfully',
    ], 200);
  }
}
