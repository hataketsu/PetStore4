@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/cart">Giỏ hàng</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Thanh toán</div>
        </div>


        <div class="ui grid" style="margin-top: 10px">
            <div class="two wide column">
            </div>
            <div class="twelve wide column">
                <div class="ui  segment">
                    <h3 class="ui dividing header">Thông tin thanh toán</h3>
                    @include('layouts.errors_block')

                    @if($discounted<$total)
                        <h3 div class="ui gray huge header">
                            <del>Tổng cộng: {{$total}}$</del>
                        </h3>
                        <h3 div class="ui huge red dividing header">Giảm giá: {{round($discounted,2)}}$</h3>
                    @else
                        <h3 div class="ui  huge blue dividing header">Tổng cộng: {{$total}}$</h3>
                    @endif

                    <form class="ui form" method="post" action="/save_checkout">
                        {{csrf_field()}}
                        @include('ui.form.input',['name'=>'email','label'=>'Email *','type'=>'email'])
                        @include('ui.form.input',['name'=>'name','label'=>'Tên người nhận *','type'=>'text'])
                        @include('ui.form.input',['name'=>'phone','label'=>'Số điện thoại *','type'=>'tel'])
                        @include('ui.form.input',['name'=>'address','label'=>'Địa chỉ *','type'=>'text'])
                        @include('ui.form.textarea',['name'=>'note','label'=>'Ghi chú ','type'=>'text'])
                        <button class="ui teal button" type="submit">Xác nhận thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection