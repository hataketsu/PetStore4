@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/orders">Đơn hàng</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Đơn hàng #{{$order->id}}</div>
        </div>
        <div class="ui huge header">Đơn hàng #{{$order->id}}</div>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $i)
                @include('order.product_row',['item'=>$i])
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5" style="text-align: center;">
                    <div class="ui huge header"
                         style="margin-top: 10px;margin-bottom: 10px"
                    >Tổng cộng: {{$total}}$
                    </div>
                </th>
            </tr>
            </tfoot>
        </table>
        <div class="ui dividing header">Thông tin thanh toán</div>
        <p><strong>Người dùng:</strong> {{
        $order->user_id!=null?
        $order->user->name:
        'Guest'}}</p>
        <p><strong>Tên:</strong> {{$order->name}}</p>
        <p><strong>Email:</strong> {{$order->email}}</p>
        <p><strong>Phone:</strong> {{$order->phone}}</p>
        <p><strong>Ghi chú:</strong> {{$order->note}}</p>
    </div>

@endsection