@extends('errors.error')

@section('error-header')
    <div class="col-1">
        <img src="{{ asset('img/404-error-pic-left.svg') }}" alt="image-404" height="96">
    </div>
    <div class="col-10">
        <h1 class="error-header text-white">Ошибка 404</h1>
    </div>
@endsection

@section('error-body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-dark">Страница не найдена!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>{{ $exception->getMessage() }}</h2>
            </div>
        </div>
    </div>
@endsection