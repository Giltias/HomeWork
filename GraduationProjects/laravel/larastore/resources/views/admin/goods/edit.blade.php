@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="py-0 my-0">Редактирование позиции {{ $goods->name }}</h3>
            </div>
            <form name="newGoods" class="was-validated" action="/admin/goods/edit/change" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="goods" value="{{ $goods->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="goods-category" class="col-form-label">Категория:</label>
                                <select class="form-control" name="goods-category" id="goods-category" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if($goods->category_id === $category->id)
                                                selected
                                            @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="goods-price" class="col-form-label">Цена:</label>
                                <input type="text" class="form-control" name="goods-price" id="goods-price"
                                       value="{{ $goods->price }}"
                                       required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="goods-discount" class="col-form-label">Скидка:</label>
                                <input type="text" class="form-control" name="goods-discount"
                                       id="goods-discount"
                                       value="{{ $goods->discount }}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goods-photo" class="col-form-label">Фото:</label>
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset('img/' . $goods->photo) }}" alt="Фото товара" width="100" id="goods-image">
                            </div>
                            <div class="col">
                                <label class="btn btn-outline-secondary col-12">
                                    Загрузить новое изображение<input type="file" class="form-control" name="goods-photo" id="goods-photo" hidden>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="goods-description" class="col-form-label">Описание товара:</label>
                        <textarea class="form-control" name="goods-description" id="goods-description"
                                  required>{{ $goods->description }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <a href="/admin" class="btn btn-outline-danger">Отмена</a>
                            <input type="submit" class="btn btn-primary" value="Изменить">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection