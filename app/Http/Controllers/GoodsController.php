<?php

namespace App\Http\Controllers;

use App\Category;
use App\Game;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GoodsController extends Controller
{
    public function index()
    {
        $games = Game::all();
        $categories = Category::all();
        return view('category',['games'=>$games,'categories'=>$categories]);
    }

    //id игры
    public function single($id)
    {
        $game = Game::query()->find($id);
        $categories = Category::all();
        return view('single',['game'=>$game,'categories'=>$categories]);
    }

    public function order($game_id)
    {

        $orders = new Order();
        $orders->user_email = Auth::user()->email;
        $orders->game_id = $game_id;
        $orders->save();
        Mail::to(Auth::user())->send(new \App\Mail\Order(['game_id'=>$game_id, 'email' => Auth::user()->email]));

        return 'success!';
    }

    function add(Request $request)
    {
        $game = new Game();
        $game->name = $request->name;
        $game->price = $request->price;
        $game->category = $request->category;
        $game->description = $request->description;
        //$goods->photo = $request->photo;
        $game->image = $request->file('image')->store('uploads', 'public');
        $game->save();
        return back();
    }

    function delete(Request $request)
    {
        Game::destroy($request->id);
        return redirect()->route('admin');
    }

    function save(Request $request)
    {
        $game = Game::query()->find($request->id);
        $game->name = $request->name;
        $game->price = $request->price;
        $game->category = $request->category;
        $game->description = $request->description;
        $game->image = $request->image;
        $game->save();
        return redirect()->route('admin');
    }

}

