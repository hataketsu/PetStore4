@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Mã giảm giá</div>
        </div>
        <div class="ui huge header">Mã giảm giá</div>
        <a class="ui primary button" href="/discounts/create" style="margin-bottom: 10px"><i class="plus icon"></i>Create new code</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Tên</th>
                <th>Mã</th>
                <th>Kiểu</th>
                <th>Discount</th>
                <th>Số lần sử dụng</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @include('discount.table_row',['item'=>$item])
            @endforeach
            </tbody>
        </table>
    </div>

@endsection