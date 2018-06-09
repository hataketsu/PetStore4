@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui huge header">
            {{$title}}
        </div>
        <div class="ui grid">
            <div class="ui three wide column"></div>
            <div class="ui ten wide column">
                @include('layouts.errors_block')
                <form class="ui form" action="/manage/settings" method="post">
                    @csrf
                    <div class="ui dividing header">Thông tin liên hệ</div>
                    @include('ui.form.input',['name'=>'email','label'=>'Email','value'=>Setting::get('email','not_set@gmail.com')])
                    @include('ui.form.input',['name'=>'phone','label'=>'Điện thoại','value'=>Setting::get('phone','00000')])
                    <div class="ui dividing header">Thêm liên kết</div>
                    @include('ui.form.input',['name'=>'more_labels[]','label'=>'Đường dân'])
                    @include('ui.form.input',['name'=>'more_links[]','label'=>'URL'])
                    <div class="ui divider"></div>
                    @foreach(Setting::get('more_links',[]) as $label=>$link)
                        @include('ui.form.input',['name'=>'more_labels[]','label'=>'Label','value'=>$label])
                        @include('ui.form.input',['name'=>'more_links[]','label'=>'URL','value'=>$link])
                        <div class="ui divider"></div>
                    @endforeach
                    @include('ui.form.input',['name'=>'more_labels[]','label'=>'Đường dẫn'])
                    @include('ui.form.input',['name'=>'more_links[]','label'=>'URL'])
                    <div class="ui divider"></div>
                    <button class="ui primary button">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection