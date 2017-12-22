@extends('errors.error')

@section('error-header')
    <div class="col-12">
        <h1 class="error-header text-white">Ошибка 401</h1>
    </div>
@endsection

@section('error-body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-dark">Вы не авторизованы!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>{{ $exception->getMessage() }}</h2>
            </div>
        </div>
    </div>
@endsection