@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add book</div>
                    <form enctype="multipart/form-data" action="{{route('category.save',['id'=>$id])}}" method="get">
                        {{ csrf_field() }}
                        <table class="table table-bordered">
                            <tr>
                                <td>name</td>
                                <td>
                                    <input type="text" name="name">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">{{$errors->first('name')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>descr</td>
                                <td>
                                    <input type="text" name="description">
                                    @if ($errors->has('description'))
                                        <div class="alert alert-danger">{{$errors->first('description')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
