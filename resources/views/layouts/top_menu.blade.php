<div class="ui stackable  menu" style="background: #f7f7f7">
    <div class="ui container">

        <div class="left menu">

            <div class=" item">
                <form class="ui action left icon input" method="get" action="/search" style="width: 70%">
                    <i class="search icon"></i>
                    <input type="text" placeholder="Tìm kiếm for products" value="{{old('query')}}" name="query">
                    <button class="ui button" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>


        <div class="right menu">
            <a class="item" href="/cart"><i class="cart icon"></i> Giỏ hàng
                @if(Session::has('discount'))
                    <span class="ui red label">{{Session::get('discount')}}</span>
                @endif
            </a>

            <div class="ui dropdown item">
                {{Auth::check()?Auth::user()->name:'My Account'}}
                <i class="dropdown icon"></i>
                <div class="menu">
                    @if(Auth::check())
                        <a class="item" href="/orders">Xem đơn hàng</a>
                        <a class="item" href="/profile/wishlist">Danh sách yêu thích</a>
                        <a class="item" href="/profile/info">Sửa thông tin cá nhân</a>
                        <a class="item" href="/profile/password">Đổi mật khẩu</a>
                        <a class="item" href="/logout">Đăng xuất</a>
                    @else
                        <a class="item" href="/login">Đăng nhập</a>
                        <a class="item" href="/register">Đăng ký</a>
                    @endif

                </div>
            </div>

            @if(Auth::check()&&Auth::user()->is_admin)
                <div class="ui dropdown item">
                    <div class="header">Quản lý</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="/manage">Thống kê</a>
                        <a class="item" href="/manage/products">Sản phẩm</a>
                        <a class="item" href="/manage/categories">Danh mục</a>
                        <a class="item" href="/manage/users">Người dùng</a>
                        <a class="item" href="/manage/orders">Đơn hàng <span class="ui red label"
                                                                           style="margin-left: 20px">{{\App\Order::whereStatus('wait_confirm')->count()}}</span></a>
                        <a class="item" href="/manage/ads">Quảng cáo</a>
                        <a class="item" href="/manage/discounts">Mã giảm giá</a>
                        <a class="item" href="/manage/blogs">Bài viết</a>
                        <a class="item" href="/manage/settings">Cài đặt</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>