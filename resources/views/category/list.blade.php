@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Danh mục</div>
        </div>
        <div class="ui huge header">Danh mục</div>
        <a class="ui primary button" href="/categories/create" style="margin-bottom: 10px"><i class="plus icon"></i>Tạo danh mục mới</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Danh mục</th>
                <th>Sắp xếp</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @include('category.table_row',['item'=>$item])
            @endforeach
            </tbody>
        </table>
    </div>

@endsection