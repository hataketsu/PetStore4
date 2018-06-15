@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage/products">Sản phẩm</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Sửa</div>
        </div>


        <div class="ui grid" style="margin-top: 10px">
            <div class="two wide column">
            </div>
            <div class="twelve wide column">
                <div class="ui  segment">
                    <h3 class="ui dividing header">{{$title}}</h3>
                    @include('layouts.errors_block')
                    <form class="ui form" method="post" action="/products{{isset($item)?'/'.$item->id:''}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{isset($item)?method_field('put'):method_field('post')}}
                        @include('ui.form.input',['name'=>'name','label'=>'Tên *','type'=>'text'])
                        @include('ui.form.files',['name'=>'image[]','label'=>'Hình ảnh *'])
                        @if(isset($item))
                            <div class="field">
                                <div class="ui five column grid">
                                    @foreach(array_filter(explode(';',$item->image_urls)) as $image)
                                        <div class="column">
                                            <img src="/images/{{$image}}" style="margin: 4px;width: 100%">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @include('ui.form.select',['name'=>'category_id','label'=>'Danh mục *','options'=>\App\Category::all()])
                        @include('ui.form.input',['name'=>'short_detail','label'=>'Giới thiệu ngắn  *'])
                        @include('ui.form.ckeditor',['name'=>'full_html_detail','label'=>'Chi tiết sản phẩm *'])
                        @include('ui.form.input',['name'=>'price','label'=>'Giá ($) *','type'=>'number','min'=>0])
                        @include('ui.form.input',['name'=>'sale_off','label'=>'Giá khuyến mãi ($) *','type'=>'number'])
                        @include('ui.form.input',['name'=>'in_stock','label'=>'Số lượng trong kho','type'=>'number'])
                        <button class="ui primary button" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection