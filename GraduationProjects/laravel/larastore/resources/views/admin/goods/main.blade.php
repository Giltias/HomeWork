@extends('layouts.app')

@section('content')
<div class="container mt-3" id="container">
    <div class="row">
        <div class="col">
            <a href="/admin/goods/add/form" class="btn btn-success float-right add-goods">+ Добавить новую позицию</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div id="content">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>Id</th>
                        <th>Категория</th>
                        <th>Наименование</th>
                        <th>Описание</th>
                        <th>Цена</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goods as $good)
                    <tr>
                        <td class="text-center">{{ $good->id }}</td>
                        <td class="text-center">{{ $good->category->name }}</td>
                        <td>{{ $good->name }}</td>
                        <td>{{ $good->description }}</td>
                        <td class="text-center">{{ $good->price }}$</td>
                        <td class="text-center">
                            <a href="/admin/goods/edit/{{ $good->id }}" class="btn btn-primary btn-sm item-edit">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="/admin/goods/delete/{{ $good->id }}" class="btn btn-danger btn-sm item-delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection