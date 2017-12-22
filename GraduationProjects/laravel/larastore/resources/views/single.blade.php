@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-3">
                <img src="{{ asset('img/' . $goods->photo) }}" alt="Фото товара" width="200">
            </div>
            <div class="col-9">
                <h4>Наименование товара: {{ $goods->name }}</h4>
                <h5>Цена: {{ $goods->price }}$</h5>
                <p style="font-size: 1.3rem;"><b>Описание товара: </b>{{ $goods->description }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-secondary goods-order" data-id="{{ $goods->id }}">Заказать</button>
            </div>
        </div>
    </div>
    @include('modals.order');
@endsection