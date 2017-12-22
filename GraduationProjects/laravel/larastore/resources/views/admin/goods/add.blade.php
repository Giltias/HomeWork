@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="py-0 my-0">Создание новой позиции в товарах</h3>
            </div>
            <form name="newGoods" class="was-validated" action="/admin/goods/add/create" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="add-goods-name" class="col-form-label">Наименование:</label>
                                <input type="text" class="form-control" name="add-goods-name" id="add-goods-name"
                                       required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="add-goods-category" class="col-form-label">Категория:</label>
                                <select class="form-control" name="add-goods-category" id="add-goods-category" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="add-goods-price" class="col-form-label">Цена:</label>
                                <input type="text" class="form-control" name="add-goods-price" id="add-goods-price"
                                       required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="add-goods-discount" class="col-form-label">Скидка:</label>
                                <input type="text" class="form-control" name="add-goods-discount"
                                       id="add-goods-discount"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="add-goods-photo" class="col-form-label">Фотография товара:</label>
                        <label class="btn btn-outline-secondary col-12">
                            Загрузите изображение<input type="file" class="form-control" name="add-goods-photo"
                                                        id="add-goods-photo" hidden>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="add-goods-description" class="col-form-label">Описание товара:</label>
                        <textarea class="form-control" name="add-goods-description" id="add-goods-description"
                                  required></textarea>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <a href="/admin" class="btn btn-outline-danger">Отмена</a>
                            <input type="submit" class="btn btn-primary" value="Создать">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection