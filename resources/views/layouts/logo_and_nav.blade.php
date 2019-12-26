<div class="ui container" style="margin-top: 60px">
    <div class="ui two column stackable grid">
        <a class="column" style="padding-left: 100px" href="/">
            <div class="ui huge header"><span class="brand_name">NAT</span><span class="store_name">Store</span></div>
            <div class="ui small header">Find you shoes</div>
        </a>
        <div class="column">
            <div class="ui borderless stackable menu">
                <a class="item {{Request::is('/')?'active':''}}" href="/">Trang chủ</a>
                <div class="ui dropdown dividing item">
                    Danh mục
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="{{Request::is('all')?'active':''}} item" href="/all">Tất cả</a>
                        @foreach(\App\Category::all() as $category)
                            <a href="/category/{{$category->id}}"
                               class="{{Request::is('category/'.$category->id)?'active':''}} item">{{$category->name}}</a>
                        @endforeach
                    </div>
                </div>
                <a class="item {{Request::is('sale_off')?'active':''}}" href="/sale_off">Giảm giá</a>
                <a class="item {{Request::is('blogs*')?'active':''}}" href="/blogs">Bài viết</a>
                <a class="item {{Request::is('contact')?'active':''}}" href="/contact">Liên hệ</a>
                <a class="item {{Request::is('about')?'active':''}}" href="/about">Giới thiệu</a>
            </div>
        </div>
    </div>
    <div class="ui divider"></div>

    @if(Session::has('error'))
        <div class="ui error message">
            <div class="header">
                {{Session::get('error')}}
            </div>
        </div>
        <div class="ui divider"></div>
    @endif
    @if(Session::has('message'))
        <div class="ui green message">
            <div class="header">
                {{Session::get('message')}}
            </div>
        </div>

        <div class="ui divider"></div>
    @endif
</div>