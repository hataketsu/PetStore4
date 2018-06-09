@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage/categories">Danh mục</a>
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
                    <form class="ui form" method="post" action="/categories{{isset($item)?'/'.$item->id:''}}">
                        {{csrf_field()}}
                        {{isset($item)?method_field('put'):method_field('post')}}
                        @include('ui.form.input',['name'=>'name','label'=>'Tên *','type'=>'text'])
                        @include('ui.form.input',['name'=>'sort','label'=>'Sắp xếp   order *','type'=>'number'])
                        <button class="ui primary button" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection