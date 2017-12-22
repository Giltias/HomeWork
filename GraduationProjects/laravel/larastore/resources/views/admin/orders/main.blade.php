@extends('layouts.app')

@section('content')
<div class="container mt-3" id="container">
    <div class="row">
        <div class="col">
            <div id="content">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>Id</th>
                        <th>Дата заказа</th>
                        <th>Товар</th>
                        <th>Email пользователя</th>
                        <th>Имя</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->goods->name }}</td>
                            <td class="text-center">{{ $order->email }}</td>
                            <td class="text-center">{{ $order->person }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection