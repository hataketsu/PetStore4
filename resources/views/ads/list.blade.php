@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Quảng cáo</div>
        </div>
        <div class="ui huge header">Quảng cáo</div>
        <a class="ui primary button" href="/ads/create" style="margin-bottom: 10px"><i class="plus icon"></i>Tạo quảng cáo mới</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>URL</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @include('ads.table_row',['item'=>$item])
            @endforeach
            </tbody>
        </table>
    </div>

@endsection