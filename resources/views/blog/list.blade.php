@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Bài viết</div>
        </div>
        <div class="ui huge header">Bài viết</div>
        <a class="ui primary button" href="/blogs/create" style="margin-bottom: 10px"><i class="plus icon"></i>Đăng bài mới</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Tiêu đề</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @include('blog.table_row',['item'=>$item])
            @endforeach
            </tbody>
        </table>
    </div>

@endsection