@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/"><i class="home icon"></i> Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage/ads">Quảng cáo</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$title}}</div>
        </div>


        <div class="ui grid" style="margin-top: 10px">
            <div class="two wide column">
            </div>
            <div class="twelve wide column">
                <div class="ui  segment">
                    <h3 class="ui dividing header">{{$title}}</h3>
                    @include('layouts.errors_block')
                    <form class="ui form" method="post" action="/ads{{isset($item)?('/'.$item->id):''}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{isset($item)?method_field('put'):method_field('post')}}
                        @include('ui.form.input',['name'=>'url','label'=>'URL','type'=>'text'])
                        @include('ui.form.image',['name'=>'image','label'=>'Hình ảnh'])
                        <button class="ui primary button" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection