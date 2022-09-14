<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Article::with(['user', 'category'])->latest()->get();
        return view('home', compact('posts'));
    }

    public function categories()
    {
        $categories = Category::with('user')->latest()->get();
        return view('frontend.category.index', compact('categories'));
    }

    public function createCategory()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('frontend.category.create', compact('users'));
    }

    public function storeCategory(Request $request)
    {
        Category::create($request->all());
        return redirect('/user/categories');
    }

    public function editCategory($id)
    {   
        $users = User::orderBy('name', 'asc')->get();
        $data = Category::where('id', $id)->first();
        return view('frontend.category.edit', compact('users', 'data'));
    }

    public function updateCategory(Request $request, $id)
    {
        Category::findOrFail($id)->update($request->all());
        return redirect('/user/categories');
    }

    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('/user/categories');
    }

    public function articles()
    {   
        $articles = Article::with(['user', 'category'])->latest()->get();
        return view('frontend.article.index', compact('articles'));
    }

    public function createArticle()
    {   
        $users = User::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('frontend.article.create', compact('users', 'categories'));
    }

    public function storeArticle(Request $request)
    {
        $request->validate(['image' => 'required|mimes:png,jpg,jpeg']);

        $image = $request->file('image');
        $name = $request->name . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/image/' . $name);
        $url = 'upload/image/' . $name;

        Article::insert([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $url,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'created_at' => now(),
        ]);

        return redirect('/user/articles');
    }

    public function editArticle($id)
    {
        $article = Article::with(['user', 'category'])->first();
        $categories = Category::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();

        return view('frontend.article.edit', compact('article', 'categories', 'users'));
    }

    public function updateArticle(Request $request, $id)
    {   
        Article::findOrFail($id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'updated_at' => now(),
        ]);

        return redirect('/user/articles');            
    }

    public function destroyArticle($id)
    {
        $data = Article::findOrFail($id);
    	Article::findOrFail($id)->delete();

		return redirect('/user/articles');
    }
}