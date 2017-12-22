@extends('layouts.app')

@section('content')
<div class="container mt-3" id="container">
    <div class="row">
        <div class="col">
            <a href="/admin/categories/add/form" class="btn btn-success float-right add-goods">+ Добавить новую категорию</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div id="content">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>Id</th>
                        <th>Наименование</th>
                        <th>Родитель</th>
                        <th>Скидка</th>
                        <th>Активность</th>
                        <th>Деействия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center">{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->parentname }}</td>
                            <td class="text-center">{{ $category->discount }}</td>
                            <td class="text-center">{{ $category->active }}</td>
                            <td class="text-center">
                                <a href="/admin/categories/edit/{{ $category->id }}" class="btn btn-primary btn-sm item-edit">
                                    Редактировать
                                </a>
                                <a href="/admin/categories/active/{{ $category->id }}" class="btn btn-danger btn-sm">
                                    Сменить активность
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