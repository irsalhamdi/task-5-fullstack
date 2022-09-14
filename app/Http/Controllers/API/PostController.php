<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(){
        $posts = Article::with(['user', 'category'])->paginate(1);
        return response($posts, 200);
    }

    public function store(Request $request){
        $request->validate(['title' => 'required', 'content' => 'required', 'user_id' => 'required|exists:users,id', 'category_id' => 'required|exists:categories,id']);
        $article = Article::create($request->all());
        
        return response()->json($article, 201);
    }

    public function show($id){
        $post = Article::with(['user', 'category'])->where('id', $id)->first();
        if(!$post){
            return response()->json(false, 404);
        }else{
            return response()->json($post, 200);
        }
    }

    public function update(Request $request, $id){
        $request->validate(['title' => 'required', 'content' => 'required', 'user_id' => 'required|exists:users,id', 'category_id' => 'required|exists:categories,id']);
        $post = Article::with(['user', 'category'])->where('id', $id)->first();

        if(!$post){
            return response()->json(false, 404);
        }else{
            $data = Article::findOrFail($id)->update($request->all());
            return response()->json($data, 200);
        }   
    }

    public function destroy($id){
        $post = Article::with(['user', 'category'])->where('id', $id)->first();

        if(!$post){
            return response()->json(false, 404);
        }else{
            Article::findOrFail($id)->delete();
            return response()->json(true, 204);
        }   
    }
}
