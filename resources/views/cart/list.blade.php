@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/"><i class="home icon"></i> Trang chủ</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Giỏ hàng</div>
        </div>
        <div class="ui huge header">Giỏ hàng</div>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @include('cart.table_row',['item'=>$item])
            @endforeach
            </tbody>
        </table>
        <div class="ui action input">
            <input type="text" placeholder="Mã giảm giá..." id="discount_input">
            <button class="ui red button" onclick="apply_discount()">Sử dụng</button>
            <button class="ui green button" onclick="update_cart()">
                <i class="refresh icon">  </i>
                Cập nhật giỏ hàng</button>
        </div>
        {{--<button class="ui right floated primary button">Update cart</button>--}}
        <div class="ui two column grid" style="margin-top: 20px">
            <div class="column"></div>
            <div class="column">
                <div class="ui dividing header">Giỏ hàng tổng cộng</div>
                <h1><strong>{{$total}}$
                        @if(Session::has('discount'))
                            <span style="color: orangered;">{{Session::get('discount')}}</span>
                        @endif


                    </strong></h1>
                <a class="ui icon labeled teal button" href="/checkout">
                    <i class="check icon"></i>Tiến hành thanh toán
                </a>
            </div>
        </div>
    </div>

@endsection