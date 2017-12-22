@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="py-0 my-0">Редактирование категории: {{ $cat->name }}</h3>
            </div>
            <form name="newcategory" class="was-validated" action="/admin/categories/edit/change" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="category" value="{{ $cat->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="category-parent" class="col-form-label">Родительская категория:</label>
                                <select class="form-control" name="category-parent" id="category-parent" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if($cat->parent === $category->id)
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
                                <label for="category-discount" class="col-form-label">Скидка:</label>
                                <input type="text" class="form-control" name="category-discount"
                                       id="category-discount"
                                       value="{{ $cat->discount }}"
                                       required>
                            </div>
                        </div>
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