<?php

namespace App\Http\Controllers;

use App\Category;
use App\Game;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id)
    {
        $categories = Category::all();
        $category = Category::query()->find($id);
        $games = Game::query()->select()->where('category', '=', $category->name)->get();
//        $games = Game::query()->select()->where('category','=',$category->name)->get();
        return view('category',['category'=>$category,'games'=>$games,'categories'=>$categories]);
//        var_dump($games->name);
    }

    public function add(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('admin');
    }

    public function delete(Request $request)
    {
        Category::destroy($request->id);
        return redirect()->route('admin');
    }
}
