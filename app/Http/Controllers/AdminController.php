<?php

namespace App\Http\Controllers;

use App\Adress;
use App\Category;
use App\Game;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        $games = Game::all();
        $categories = Category::all();
        $users = User::all();
        $orders = Order::all();
        $addresses = Adress::all();
        return view('admin.page', ['games' => $games, 'categories' => $categories, 'users' => $users, 'orders' => $orders, 'addresses'=>$addresses]);
    }

    function create()
    {
        return view('game.create');
    }

    function edit($id)
    {
        return view('game.edit',['id'=>$id]);
    }

    function createCategory()
    {
        return view('category.create');
    }

    function editCategory($id)
    {
        return view('category.edit',['id'=>$id]);
    }

    function saveCategory(Request $request)
    {
        $category = Category::query()->find($request->id);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('admin');
    }


}
