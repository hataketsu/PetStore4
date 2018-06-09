@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$title}}</div>
        </div>
        <div class="ui huge header">Người dùng</div>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Người dùng</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Địa chỉ</th>
                <th>Quyền hạn</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @include('user.table_row',['item'=>$item])
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

