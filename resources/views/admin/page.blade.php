@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <a href="{{route('game.create')}}">добавить</a>

                    <div class="panel-heading">Goods</div>
                    <table class="table table-bordered">
                        @foreach($games as $game)
                            <tr>
                                <td>{{$game->id}}</td>
                                <td>{{$game->name}}</td>
                                <td>{{$game->price}}</td>
                                <td>
                                    <a href="{{route('game.edit', ['id' => $game->id])}}">edit</a>
                                    <a href="{{route('game.delete', ['id' => $game->id])}}">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <a href="{{route('category.create')}}">добавить</a>

                    <div class="panel-heading">Категории</div>
                    <table class="table table-bordered">
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->desciption}}</td>
                                <td>
                                    <a href="{{route('category.edit', ['id' => $category->id])}}">edit</a>
                                    <a href="{{route('category.delete', ['id' => $category->id])}}">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h1>Orders</h1>
    <ul>
        @foreach($orders as $order)
            <li>
                {{ $order->user_email }}
                {{ $order->game_id }}
            </li>
        @endforeach
    </ul>

    <h1>Notification address</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Логин и пароль для уведомлений</div>
                    <table class="table table-bordered">
                        @foreach($addresses as $address)
                            <tr>
                                <td>{{$address->id}}</td>
                                <td>{{$address->name}}</td>
                                <td>{{$address->password}}</td>
                                <td>
                                    <a href="{{route('address.change', ['id' => $address->id])}}">edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
