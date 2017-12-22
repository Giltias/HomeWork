@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="py-0 my-0">Создание новой категории</h3>
            </div>
            <form name="newcategory" class="was-validated" action="/admin/categories/add/create" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="add-category-name" class="col-form-label">Наименование:</label>
                                <input type="text" class="form-control" name="add-category-name" id="add-category-name"
                                       required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="add-category-parent" class="col-form-label">Родительская категория:</label>
                                <select class="form-control" name="add-category-parent" id="add-category-parent" required>
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
                                <label for="add-category-discount" class="col-form-label">Скидка:</label>
                                <input type="text" class="form-control" name="add-category-discount"
                                       id="add-category-discount"
                                       value="0"
                                       required>
                            </div>
                        </div>
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