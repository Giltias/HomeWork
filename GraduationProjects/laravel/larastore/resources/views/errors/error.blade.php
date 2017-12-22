@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-danger error-content py-3">
        <div class="container">
            <div class="row">
                @yield('error-header')
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center py-3">
                @yield('error-body')
            </div>
        </div>
    </div>
@endsection