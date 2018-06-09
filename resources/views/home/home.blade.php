@extends('layouts.default')
@section('content')
    @include('home.banner')
    <div class="ui container">
        <h1>Sản phẩm mới nhất</h1>
        <div class="ui four column stackable grid">
            @foreach(\App\Product::query()->orderByDesc('updated_at')->take(4)->get() as $product)
                <div class="column">
                    @include('product.card',['item'=>$product])
                </div>
            @endforeach
        </div>

        @if($top_views->count()>0)
            <h1>Xem nhiều nhất hôm nay</h1>
            <div class="ui four column stackable grid">
                @foreach($top_views as $log)
                    @if($log->product!=null)
                        <div class="column">
                            @include('product.card',['item'=>$log->product])
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        @if($top_sold->count()>0)
            <h1>Bán nhiều nhất hôm nay</h1>
            <div class="ui four column stackable grid">
                @foreach($top_sold as $log)
                    @if($log->product!=null)
                        <div class="column">
                            @include('product.card',['item'=>$log->product])
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <h1>Sản phẩm ngẫu nhiên</h1>
        <div class="ui four column stackable grid">
            @foreach(\App\Product::orderByRaw('RAND()')->take(4)->get() as $product)
                <div class="column">
                    @include('product.card',['item'=>$product])
                </div>
            @endforeach
        </div>
    </div>
@endsection