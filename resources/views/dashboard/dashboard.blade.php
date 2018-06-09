@extends('layouts.default')
@section('content')
    <div class="ui container">
        <div class="ui huge header">Quản lý dashboard
            <div class="ui sub header">Quản lý every thing</div>
        </div>
        <br>
        @include('dashboard.total')
        <br>
        <br>
        <br>
        @include('dashboard.last_month')

    </div>

@endsection