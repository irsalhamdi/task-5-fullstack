<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('user')->get();
        return response()->json($categories, 200);
    }

    public function store(Request $request){
        $request->validate(['name' => 'required', 'user_id' => 'required|exists:users,id']);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function show($id){
        $category = Category::with('user')->where('id', $id)->first();

        if(!$category){
            return response()->json(false, 404);
        }else{
            return response()->json($category, 200);
        }
    }

    public function update(Request $request, $id){
        $request->validate(['name' => 'required', 'user_id' => 'required|exists:users,id']);
        $category = Category::where('id', $id)->first();

        if(!$category){
            return response()->json(false, 404);
        }else{
            $data = Category::findOrFail($id)->update($request->all());
            return response()->json($data, 200);
        }
    }

    public function destroy($id){
        $category = Category::where('id', $id)->first();

        if(!$category){
            return response()->json(false, 404);
        }else{
            Category::findOrFail($id)->delete();
            return response()->json(true, 204);
        }
    }
}
