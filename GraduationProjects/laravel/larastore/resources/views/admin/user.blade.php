@extends('layouts.app')

@section('content')
<div class="container mt-3" id="container">
    <div class="row">
        <div class="col">
            <form action="/admin/notification/change" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="goods-discount" class="col-form-label">Адрес для уведомлений (если пусто, уведомления приходить не будут):</label>
                    <input type="text" class="form-control" name="notifEmail" value="{{ $user->notif_email }}">
                </div>
                <div class="row">
                    <div class="col text-right">
                        <a href="/admin" class="btn btn-outline-danger">Отмена</a>
                        <input type="submit" class="btn btn-primary" value="Изменить">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection