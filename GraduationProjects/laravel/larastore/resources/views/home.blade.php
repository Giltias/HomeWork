@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col">
            <div class="d-flex flex-row flex-wrap">
                @forelse($goods as $good)
                        <div class="col-2 pt-2 pb-2 d-flex flex-column align-items-center goods-item" data-id="{{ $good->id }}" style="min-height: 220px">
                            <div class="d-flex flex-column justify-content-center" style="min-height: 125px; max-height: 125px">
                                <img src="{{ asset('img/' . $good->photo) }}" width="100" style="max-height: 125px" alt="">
                            </div>
                            <div class="w-100 d-flex flex-column block-overflow">
                                <span><b>{{ $good->name }}</b></span>
                                <span>Price: {{ $good->price }}$</span>
                                <span class="text-desc" data-toggle="tooltip" data-placement="bottom"
                                      title="{{ $good->description }}">
                                    Desc: {{ $good->description }}
                                </span>
                                {{--@if (!Auth::guest())--}}
                                    <div class="text-right">
                                        <button class="btn btn-secondary goods-order">Заказать</button>
                                    </div>
                                {{--@endif--}}
                            </div>
                        </div>
            @empty
                <div class="col-12">
                    <h3>По данной категории товары не найдены!</h3>
                </div>
            @endforelse
            </div>
        </div>
    </div>
</div>
@include('modals.order');
@endsection
