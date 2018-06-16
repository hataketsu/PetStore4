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

        @foreach(\App\Category::all() as $category)
            <h1>Danh mục "{{$category->name}}"</h1>
            <div class="ui four column stackable grid">
                @foreach($category->products->take(8) as $product)
                    <div class="column">
                        @include('product.card',['item'=>$product])
                    </div>
                @endforeach
            </div>
        @endforeach

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