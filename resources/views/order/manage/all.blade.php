@extends('layouts.default')
@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <div class="section" href="/orders">Đơn hàng</a>
            </div>
        </div>
        <div class="ui huge header">Quản lý tất cả đơn hàng</div>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Đơn hàng</th>
                <th>Người dùng</th>
                <th>Tổng cộng</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @include('order.manage.order_row',['item'=>$item])
            @endforeach
            </tbody>
        </table>
    </div>
    </div>

@endsection

