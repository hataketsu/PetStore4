@extends('layouts.default')
@section('content')
    <div class="ui container">
        <div class="ui stackable grid">
            <div class="four wide column">
                <div class="ui huge header">Kết quả lọc</div>
                <form class="ui form" action="{{Request::fullUrl()}}">
                    @include('ui.form.text',['name'=>'query','label'=>'Tìm kiếm'])
                    <div class="field">
                        <label for="amount">Khoảng giá: </label>
                        <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        <input type="hidden" name="lower_price" id="lower_price">
                        <input type="hidden" name="higher_price" id="higher_price">
                    </div>
                    <div id="slider-range"></div>
                    <br>
                    @include('ui.form.select2',['name'=>'sortby','label'=>'Sắp xếp bởi:',
                    'options'=>[
                    'price'=>'Giá',
                    'time'=>'Thời gian',
                    ]])
                    @include('ui.form.select2',['name'=>'orderby','label'=>'Thứ tự:',
                    'options'=>[
                    'desc'=>'Giảm dần',
                    'asc'=>'Tăng dần',
                    ]])
                    <br>
                    <button class="ui primary labeled icon button" type="submit"><i class="filter icon"></i>Lọc
                    </button>
                </form>
                <br>
            </div>
            <div class="twelve wide column">
                <div class="ui huge header">{{$title}}
                    <div class="ui sub header">{{$products->count()}} kết quả</div>
                </div>
                <br>
                <div class="ui three column stackable grid">
                    @foreach($products as $product)
                        <div class="column">
                            @include('product.card',['item'=>$product])
                        </div>
                    @endforeach
                </div>
                <div class="ui content" style="text-align: center">
                    <br>
                    {{$products->links('vendor.pagination.semantic-ui')}}
                </div>
            </div>
        </div>
    </div>
@endsection